<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\BlockedUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\User\SimpleUserResource;

class SimpleChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userId = auth()->id();

        // Use model methods for cleaner logic
        // $latestChat = Chat::getLatestChat($this->ad_id, $userId);
        // $unreadMessagesCount = Chat::getUnreadMessagesCount($this->resource->ad_id, $userId);
        // $isBlocked = BlockedUser::isBlocked($userId, $this->receiver_id);

        return [
            'id' => $this->id,
            'chat_id' => (string) $this->chat_id,
            'is_blocked' => $this->is_blocked,
            'ad_id' => (string) $this->ad_id,
            'receiver' => SimpleUserResource::make($this->receiver),
            'message' => $this->message,
            // 'created_at' => $latestChat ? Carbon::parse($latestChat->created_at)->format('Y-m-d') : null,
            // 'count_un_read_message' => $unreadMessagesCount,
            // 'is_blocked' => $isBlocked
        ];
    }
}
