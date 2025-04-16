<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use App\Services\General\FollowingService;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userIdPassedFromAnotherPlace = $this->additional['favoritable_user_id'] ?? null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $this->avatar != null ? url('').'/'.$this->avatar : url('').'/'.'public/admin/dist/img/avatar.png',
            'rate' => 5,
            'phone' => '+966' . $this->phone,
            'is_following' => $userIdPassedFromAnotherPlace
            ? (bool) FollowingService::isFollow($userIdPassedFromAnotherPlace)
            : false,
                ];
    }
}
