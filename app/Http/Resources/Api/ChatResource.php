<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\BlockedUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\User\SimpleUserResource;
use App\Services\General\FormatFileService;

class ChatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $userId = auth()->id();
        $otherUser = ($this->sender_id == $userId) ? $this->receiver : $this->sender;

        if ($this->resource->ad_id) {
            $latestChat = Chat::getLatestChat($this->resource->ad_id, null, $userId);
            $unreadMessagesCount = Chat::getUnreadMessagesCount($this->resource->ad_id, null, $userId);
        } else {
            $latestChat = Chat::getLatestChat(null, $this->resource->order_id, $userId);
            $unreadMessagesCount = Chat::getUnreadMessagesCount(null, $this->resource->order_id, $userId);
        }

        $isBlocked = BlockedUser::isBlocked($userId, $otherUser->id);
        $unreadMessagesCount = Chat::getUnreadMessagesCount(null, $this->resource->order_id, $userId);
        return [
            'id' => $this->id,
            'ad_id' => (string) ($this->ad_id ?? ""),
            'chat_id' => (string) ($this->chat_id ?? ""),
            'participant' => SimpleUserResource::make($otherUser), // Show only the other participant
            'message' => (string) ($this->message ?? ""),
            'files' => FormatFileService::formatFileIfModel($this->files) ?? [],
            'created_at' => $latestChat ? Carbon::parse($latestChat->created_at)->format('Y-m-d') : "",
            'is_blocked' => $isBlocked,
            'unreadMessagesCount' => $unreadMessagesCount,
            'date' => Carbon::parse($this->created_at)->format('Y-m-d') ?? "",
            'time' => Carbon::parse($this->created_at)->format('H:i') ?? "",
        ];
    }
}
