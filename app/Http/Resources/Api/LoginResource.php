<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use App\Services\General\FollowingService;
use App\Services\General\FormatFileService;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $userIdPassedFromAnotherPlace = $this->additional['favoritable_user_id'] ?? null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'token' => $this->token(),
            'rate' => number_format((string)ceil($this->averageRating() * 2) / 2, 1) ?? '0.0',
            'number_of_rate' => $this->ratings()->count(),
            'membership_type' => $this->membership_type ?? "",
            'avatar' => $this->avatar != null ? url('') . '/' . $this->avatar : url('') . '/' . 'public/admin/dist/img/avatar.png',
            'created_at' => Carbon::parse($this->created_at)->format("Y-m-d"),
            'val_license' => $this->getRealEstateAuthorityLicense()
                ? FormatFileService::formatIfString($this->getRealEstateAuthorityLicense()->file, '')
                : [],
            'tourism_license' => $this->getTourismLicense()
                ? FormatFileService::formatIfString($this->getTourismLicense()->file, '')
                : [],

            'verified' => true,
            'is_following' => $userIdPassedFromAnotherPlace
                ? (bool) FollowingService::isFollow($userIdPassedFromAnotherPlace)
                : false,
            'ads_count' => $this->ads()->count(),
            'orders_count' => $this->orders()->count(),
            'last_login' => $this->last_login
                ? Carbon::parse($this->last_login)->diffForHumans()
                : '',
        ];
    }
}
