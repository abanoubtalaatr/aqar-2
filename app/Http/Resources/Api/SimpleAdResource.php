<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\General\FormatPrice;
use App\Services\General\FavoriteService;
use App\Services\General\FollowingService;
use App\Services\General\FormatFileService;
use App\Http\Services\NameContestantService;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleAdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        if (auth('api')->user() == null) {
            $ad_owner = false;
        } else {
            if ($this->user_id == auth('api')->user()->id) {
                $ad_owner = true;
            } else {
                $ad_owner = false;
            }
        }

        return [
            //main fields for ads
            'chat_id' => (string) $this->chatWithUser($this->id)?->chat_id,
            'id' => $this->id,
            'name' => ((string) $this->category?->name . ' ' . ($this->for_rent == 0 ? __('mobile.for_sell') : __("mobile.for_rent"))),
            'for_rent' => (bool) $this->for_rent,
            'category_name' => ((string) $this->category?->name . ' ' . ($this->for_rent == 0 ? __("mobile.for_sell") : __('mobile.for_rent'))),
            'views_count' => (string) ($this->views_count ?? 0),
            'saved_count' => (string) $this->favoriteCount(),
            'is_golden' => (bool) $this->is_golden,
            'category_id' => $this->category?->id ?? "",
            'category' => SimpleCategoryResource::make($this->category),
            'price' => (string) $this->price,
            'format_price' => number_format($this->price, 0, ',', ','),
            'map_price' => (string)FormatPrice::format($this->price),
            'area' => (string) $this->area,
            'length' => (string) $this->length,
            'width' => (string) $this->width,

            'property_age' => (string) $this->property_age,
            'description' => (string) $this->description,
            'map_latitude' => (string) $this->map_latitude,
            'map_longitude' => (string) $this->map_longitude,
            'address' => (string) $this->map_address,
            'my_ad' => (bool) $ad_owner,
            'image' => FormatFileService::formatFileIfModel($this->files->where('type', '!=', 1)->first()),
            'images' => FormatFileService::formatFileIfModel($this->files->where('type', '!=', 1)),

            'has_video' => $this->files->where('type', 1)->isNotEmpty(),
            'face_building' => $this->face_building_id
                ? $this->faceBuilding->{'name_' . app()->getLocale()}
                : "",

                'published_at' => str_replace('منذ ', '', (string) Carbon::parse($this->published_at)->diffForHumans()),
                'created_at' => str_replace('منذ ', '', (string) Carbon::parse($this->created_at)->diffForHumans()),
                'last_updated_at' => str_replace('منذ ', '', (string) Carbon::parse($this->last_updated_at)->diffForHumans()),

            'street_width' => (string) ($this->adable->street_width ?? ""),
            'floor_number' => (string) ($this->adable->floor_number ?? ""),
            'has_attached' => (bool) ($this->adable->has_attached ?? false),

            'is_updated' => (bool) $this->is_updated,

            'is_saved' => (bool) FavoriteService::isFavorited($this->id, "Ad"),
            'room_of_numbers' => (string)($this->adable?->number_of_rooms ?? ""),
            'is_following' => auth()->check() ? (bool) FollowingService::isFollow(auth()->id()) : false,
            'is_equipped' => $this->adable?->is_equipped ? true : false,
            'is_rented' =>  $this->adable?->is_rented ? true : false,
            'has_elevator' => $this->adable?->has_elevator ? true : false,
            'price_meter' => (string) ($this->adable->price_meter ?? ""),
            'format_price_meter' => number_format($this->price_meter, 0, ',', ','),
            'number_of_apartments' => (string) ($this->adable->number_of_apartments ?? ""),
            'number_of_halls' => (string) ($this->adable->number_of_halls ?? ""),
            'number_of_bathrooms' => (string) ($this->adable->number_of_bathrooms ?? ""),
            'number_of_shops' => (string) ($this->adable->number_of_shops ?? ""),
            'number_of_trees' => (string) ($this->adable->number_of_trees ?? ""),
            'number_of_wells' => (string) ($this->adable->number_of_wells ?? ""),
            'number_of_rooms' => (string) ($this->adable->number_of_rooms ?? ''),
            'number_of_units' => (string) ($this->adable->number_of_units ?? ""),
            'purpose_id' => (string) ($this->adable?->purpose ?? ""),
            'purpose' => (string) (isset($this->adable?->purpose) ? NameContestantService::getPurposeName($this->adable->purpose) : ""),
            'purpose_title' => (string) (isset($this->adable?->purpose) ? NameContestantService::getPurposeTitle($this->adable->purpose) : ""),
            'purpose_icon_name' => (string) (isset($this->adable?->purpose) ? NameContestantService::getPurposeIconNumber($this->adable->purpose) : ""),
            'visited_before' => $this->visits->contains('user_id', auth()->id()),
        ];
    }
}
