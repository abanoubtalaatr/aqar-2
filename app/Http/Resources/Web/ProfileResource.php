<?php

namespace App\Http\Resources\Web;

use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'my_rate' => Rate::where('user_id', $this->id)->avg('rate'),
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->avatar != null ? url('').'/'.$this->avatar : url('').'/'.'public/admin/dist/img/avatar.png',
            'about' => $this->about,
            'membership_type' => $this->membership_type,
            'marketing_license' => $this->marketing_license,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),

            // 'real_estate_license' => $this->real_estate_license,
            // 'rate' => $this->rate,
            // 'rate_counts' => $this->rates->count(),
            // 'current_rate' => $this->current_rate ,
        ];
    }
}
