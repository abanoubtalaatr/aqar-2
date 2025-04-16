<?php

namespace App\Http\Resources\Web;

use App\Models\Ad;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapAdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->for_rent == 1) {
            $for_rent = $this->RentingDurationVal;
            $renting_duration = $this->renting_duration;
        } else {
            $for_rent = $this->for_rent_val;
            $renting_duration = null;
        }
        if (auth('api')->user() == null) {
            $ad_owner = false;
        } else {
            if ($this->user_id == auth('api')->user()->id) {
                $ad_owner = true;
            } else {
                $ad_owner = false;
            }
        }
        if (auth('api')->user() == null) {
            $my_rate = null;
            $ad_owner_rate = null;
        } else {
            $my_rate = Rate::where('rater_id', auth('api')->user()->id)->where('user_id', $this->user_id)->first()->rate ?? null;
            $ad_owner_rate = Rate::where('user_id', $this->user_id)->pluck('rate')->avg() ?? null;
        }

        return [
            'my_rate' => $my_rate,
            'ad_owner_rate' => $ad_owner_rate,
            'previous_id' => Ad::where('id', '<', $this->id)->where('is_active', 1)->where('category_id', $this->category_id)->where('for_rent', $this->for_rent)->latest('id')
                ->first()->id ?? null,
            'next_id' => Ad::where('id', '>', $this->id)->orderBy('id')->where('is_active', 1)->where('category_id', $this->category_id)->where('for_rent', $this->for_rent)->first()->id ?? null,
            'id' => $this->id,
            'name' => optional($this->category)->name.$this->for_rent_val.__('dashboard.in').optional($this->neighborhood)->name.' '.__('dashboard.in').optional($this->neighborhood->city)->name,
            'for_rent' => $for_rent,
            'for_rent_id' => $this->for_rent,
            'renting_duration_id' => $renting_duration,
            'advertiser_relationship_with_property_id' => $this->advertiser_relationship_with_property,

            'ad_number' => $this->ad_number,
            'views_count' => $this->views_count,
            'is_fav' => $this->is_favourite,
            'is_active' => $this->is_active,
            'is_star' => $this->stared,
            'map_latitude' => $this->map_latitude,
            'map_longitude' => $this->map_longitude,
            'price' => $this->price,
            'currency_name' => $this->currency->name,
            'neighborhood_name' => optional($this->neighborhood)->name,
            'city_name' => optional($this->neighborhood->city)->name,
            'country_name' => optional($this->neighborhood->city->country)->name,
            'area' => $this->area,
            'length' => $this->length,
            'width' => $this->width,
            'images' => FileResource::collection($this->files->where('type', 0)),
            'videos' => FileResource::collection($this->files->where('type', 1)),

        ];
    }
}
