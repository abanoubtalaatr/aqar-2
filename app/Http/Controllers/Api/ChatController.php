<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use App\Events\ChatEvent;
use App\Models\BlockedUser;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChatRequest;
use App\Http\Resources\Api\ChatResource;
use App\Services\UploadFileForChatService;
use App\Http\Resources\Api\DetailsChatResource;

class ChatController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        $userId = auth()->id();
        $userName = auth()->user()->name;
        $searchName = $request->input('search');
        $paginate = $request->has('paginate') && $request->input('paginate') == 1;

        // Subquery to get the latest message from the other participant per chat_id
        $latestChats = Chat::select('chat_id', DB::raw('MAX(created_at) as max_created_at'))
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->where('sender_id', '!=', $userId) // Exclude messages sent by the authenticated user
            ->groupBy('chat_id');

        // Main query joining with the subquery
        $query = Chat::query()
            ->joinSub($latestChats, 'latest', function ($join) {
                $join->on('chats.chat_id', '=', 'latest.chat_id')
                    ->on('chats.created_at', '=', 'latest.max_created_at');
            })
            ->with(['sender', 'receiver'])
            ->when($searchName, function ($query) use ($searchName, $userName) {
                $query->where(function ($q) use ($searchName, $userName) {
                    $q->whereHas('sender', function ($q) use ($searchName, $userName) {
                        $q->where('name', 'LIKE', "%{$searchName}%")
                            ->where('name', '!=', $userName);
                    })
                        ->orWhereHas('receiver', function ($q) use ($searchName, $userName) {
                            $q->where('name', 'LIKE', "%{$searchName}%")
                                ->where('name', '!=', $userName);
                        });
                });
            })
            ->orderBy('chats.created_at', 'desc');

        // Fetch chats: paginated or all
        $chats = $paginate ? $query->paginate() : $query->get();

        // Count unread messages for the user
        $unreadMessagesCount = Chat::where('receiver_id', $userId)
            ->whereNull('receiver_read_at')
            ->where('message', '!=', '')
            ->where('sender_id', '!=', $userId)
            ->count();

        // Transform chats using resource collection
        $chatsResource = ChatResource::collection($chats);

        // Prepare response data
        if ($paginate) {
            $data = $chatsResource->response()->getData(true);
            $data['unreadMessagesCount'] = $unreadMessagesCount;
        } else {
            $data = [
                'chats' => $chatsResource,
                'unreadMessagesCount' => $unreadMessagesCount,
            ];
        }

        return $this->returnData('data', $data);
    }

    public function getChat($chatId, Request $request)
    {
        try {
            // Fetch messages, excluding empty ones, with default Laravel pagination
            $messages = Chat::where('chat_id', $chatId)
                ->where('is_first_message', 0)
                ->orderBy('created_at', 'asc') // Messages within each date: oldest to newest
                ->paginate(10000);

            if ($messages->isEmpty() && Chat::where('chat_id', $chatId)->count() === 0) {
                return $this->returnError(404, 'Chat not found');
            }

            $userId = auth()->id();

            // Group messages by day and transform with ChatResource
            $groupedMessages = $messages->getCollection()
                ->groupBy(function ($message) use ($request) {
                    return Carbon::parse($message->created_at)->format('Y-m-d');
                })
                ->map(function ($group, $date) {
                    return [
                        'date' => $date,
                        'messages' => DetailsChatResource::collection($group),
                    ];
                })
                ->sortByDesc('date') // Sort dates in descending order (newest to oldest)
                ->values();

            // Replace the original collection with the grouped one
            $messages->setCollection($groupedMessages);

            // Mark messages as read for receiver
            Chat::where('chat_id', $chatId)
                ->where('receiver_id', $userId)
                ->whereNull('receiver_read_at')
                ->update(['receiver_read_at' => now()]);

            // Count unread messages
            $unreadMessagesCount = Chat::where('receiver_id', $userId)
                ->whereNull('receiver_read_at')
                ->where('sender_id', '!=', $userId)
                ->count();

            // Return JSON response with default Laravel pagination
            return response()->json([
                'status' => true,
                'msg' => '',
                'data' => [
                    'messages' => $messages,
                    'unreadMessagesCount' => $unreadMessagesCount
                ],
                'is_verify' => true,
            ]);
        } catch (\Exception $e) {
            return $this->returnError(500, 'An error occurred while fetching chat messages');
        }
    }
    public function store(ChatRequest $request)
    {
        try {
            $userId = auth()->id();
            $receiverId = $request->input('receiver_id');

            // Check if user is blocked
            $isBlocked = BlockedUser::isBlocked($userId, $receiverId);
            if ($isBlocked) {
                return $this->returnError(400, __('mobile.This user is blocked'));
            }

            $filePaths = [];
            $filePathsString = implode(',', $filePaths);

            // Check existing chat
            $existChat = Chat::find($request->input('chat_id'));

            if ($existChat) {
                $chat = Chat::create([
                    'ad_id' => $existChat->ad_id,
                    'chat_id' => $existChat->chat_id,
                    'sender_id' => $userId,
                    'receiver_id' => $receiverId,
                    'sender_read_at' => now(),
                    'file' => $filePathsString ?? null,
                    'message' => $request->input('message'),
                    'is_closed' => 0,
                ]);
            } else {
                // First message in new chat
                $chat = Chat::create([
                    'sender_id' => $userId,
                    'receiver_id' => $receiverId,
                    'sender_read_at' => now(),
                    'file' => $filePathsString ?? null,
                    'message' => $request->input('message'),
                    'ad_id' => $request->ad_id,
                    'is_closed' => 0,
                ]);

                $chat->chat_id = $chat->id;
                $chat->save();
            }

            // Handle file uploads
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    (new UploadFileForChatService())->upload($file, $chat, 2);
                }
            }

            $chatResource = DetailsChatResource::make($chat);

            // Fire chat event
            event(new ChatEvent($chatResource));

            return response()->json([
                'data' => $chatResource,
                'message' => __('Send successfully'),
                'status' => true,
            ]);
        } catch (\Exception $e) {
            return $this->returnError(500, 'An error occurred while sending the message');
        }
    }
}
