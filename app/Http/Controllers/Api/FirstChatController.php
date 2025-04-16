<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ChatResource;
use App\Http\Requests\Api\FirstChatRequest;

class FirstChatController extends Controller
{
    use GeneralTrait;
    public function __invoke(FirstChatRequest $request)
    {

        $existChat = Chat::query();
        $existChat =  $existChat->where(function ($query) use ($request) {
            $query->where('receiver_id', $request->input('receiver_id'))
                ->where('sender_id', auth()->id());
        })
            ->orWhere(function ($query) use ($request) {

                $query->where('sender_id', $request->input('receiver_id'))
                    ->where('receiver_id', auth()->id());
            })
            ->first();
        if ($existChat) {
            return $this->returnData('chat', ChatResource::make($existChat));
        }

        $chat = Chat::create([
            'receiver_id' => $request->input('receiver_id'),
            'sender_id' => auth()->id(),
            'message' => "",
            'is_closed' => 0,
            'is_first_message' => 1
        ]);

        $chat->chat_id = $chat->id;
        $chat->save();

        return $this->returnData('chat', ChatResource::make($chat));
    }
}
