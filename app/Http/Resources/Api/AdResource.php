<?php

namespace App\Http\Resources\Api;

use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RandomMessage;
use App\Services\General\FormatPrice;
use App\Services\General\FavoriteService;
use App\Services\General\FollowingService;
use App\Services\General\FormatFileService;
use App\Http\Services\NameContestantService;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
            // 'auth_user_id' => auth('api')->user() == null ? null : auth('api')->user()->id,
            'id' => $this->id,
            'name' => ((string) $this->category?->name . ' ' . ($this->for_rent == 0 ? __('mobile.for_sell') : __('mobile.for_rent'))),
            'for_rent' => (bool) $this->for_rent,
            'per_day_or_month' => (bool) $this->per_day_or_month,
            'category_name' => ((string) $this->category?->name . ' ' . ($this->for_rent == 0 ? __('mobile.for_sell') : __('mobile.for_rent'))),
            'license_number' => (string)($this->license_number),
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
            'face_building' => $this->face_building_id
                ? $this->faceBuilding->{'name_' . app()->getLocale()}
                : "",

            'published_at' => Carbon::parse($this->published_at)->diffForHumans(),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'last_updated_at' =>  Carbon::parse($this->updated_at)->diffForHumans(),

            'my_ad' => (bool) $ad_owner,
            'user' => $this->user ? LoginResource::make($this->user)->additional([
                'favoritable_user_id' => $this->user_id ?? null, // Ensure favoritable relationship is loaded
            ]) : [],
            'images' => FormatFileService::formatFileIfModel($this->files->where('type', '!=', 1)),
            'videos' => FormatFileService::formatFileIfModel($this->files->where('type', 1)),
            'car_entrance' => $this->adable?->car_entrance ? true : false,
            'bound_for_sale' => (bool)($this->bound_for_sale),
            'advertiser_owner' => (bool)($this->advertiser_owner),
            'is_debt' => (bool)($this->is_debt),
            'is_saved' => (bool) FavoriteService::isFavorited($this->id, "Ad"),
            'chat_id' => (string) $this->chatWithUser($this->id)?->chat_id,
            'random_messages' => RandomMessageResource::collection(
                RandomMessage::where('is_active', true)->inRandomOrder()->limit(1)->get()
            ),

            'is_updated' => (bool) $this->is_updated,

            //extra fields
            'renting_duration' => (string) $this->renting_duration,
            'renting_duration_name' => $this->renting_duration
            ? (string) NameContestantService::getRentDurationName($this->renting_duration)
            : "",
                    'is_following' => auth()->check() ? (bool) FollowingService::isFollow(auth()->id()) : false,
            'face_building_id' => (string) ($this->face_building_id ?? ""),
            'has_elevator' => (bool) ($this->adable?->has_elevator ? true : false),
            'has_interior_staircase' => (bool) ($this->adable?->has_interior_staircase ? true : false),
            'furnished' => $this->adable?->furnished ? true : false,
            'sewerage_supply' => $this->adable?->sewerage_supply ? true : false,
            'electricity_supply' => $this->adable?->electricity_supply ? true : false,
            'water_supply' => $this->adable?->water_supply ? true : false,
            'kitchen' => $this->adable?->kitchen ? true : false,
            'furnished' => $this->adable?->furnished ? true : false,
            'driver_room' => $this->adable?->driver_room ? true : false,
            'air_conditioner' => $this->adable?->air_conditioner ? true : false,
            'maid_room' => $this->adable?->maid_room ? true : false,
            'swimming_pool' => $this->adable?->swimming_pool ? true : false,
            'elevator' => $this->adable?->elevator ? true : false,
            'has_cellar' => $this->adable?->has_cellar ? true : false,
            'has_attached' => $this->adable?->has_attached ? true : false,
            'pool' => $this->adable?->pool ? true : false,
            'is_offices' => $this->adable?->is_offices ? true : false,
            'has_offices' => $this->adable?->has_offices ? true : false,
            'is_cellar' => $this->adable?->is_cellar ? true : false,
            'is_equipped' => $this->adable?->is_equipped ? true : false,
            'is_rented' =>  $this->adable?->is_rented ? true : false,
            'number_of_shops' => (string) ($this->adable?->number_of_shops ?? ""),
            'number_of_floors' => (string) ($this->adable?->number_of_floors ?? ""),
            'number_of_elevators' => (string) ($this->adable?->number_of_elevators ?? ""),
            'number_of_trees' => (string) ($this->adable?->number_of_trees ?? ""),
            'number_of_wells' => (string) ($this->adable?->number_of_wells ?? ""),
            'number_of_rooms' => (string) ($this->adable?->number_of_rooms ?? ''),
            'room_of_numbers' => (string)($this->adable?->number_of_rooms ?? ""),
            'number_of_units' => (string) ($this->adable?->number_of_units ?? ""),
            'meter_price' => (string) ($this->adable?->price_meter ?? ""),
            'format_meter_price' => number_format($this->meter_price, 0, ',', ','),
            'age_property' => (string) ($this->adable?->age_property ?? ""),
            'number_of_living_rooms' => (string) ($this->adable?->number_of_living_rooms ?? ""),
            'height' => (string) ($this->adable?->height ?? ""),
            'number_of_apartments' => (string) ($this->adable?->number_of_apartments ?? ""),
            'number_of_halls' => (string) ($this->adable?->number_of_halls ?? ""),
            'number_of_bathrooms' => (string) $this->adable?->number_of_bathrooms ?? "",
            'floor_number' => (string) $this->adable?->floor_number ?? "",
            'street_width' => (string) ($this->adable?->street_width ?? ""),
            'purpose_id' => (string) ($this->adable?->purpose ?? ""),
            'purpose' => (string) (isset($this->adable?->purpose) ? NameContestantService::getPurposeName($this->adable->purpose) : ""),
            'purpose_title' => (string) (isset($this->adable?->purpose) ? NameContestantService::getPurposeTitle($this->adable->purpose) : ""),
            'purpose_icon_name' => (string) (isset($this->adable?->purpose) ? NameContestantService::getPurposeIconNumber($this->adable->purpose) : ""),
            'visited_before' => $this->visits->contains('user_id', auth()->id()),
            'similar_products' => SimpleAdResource::collection($this->similarAds($this)),
        ];


    }

    public function similarAds($ad)
    {   
        $areaRange = [
            'min' => $this->area * 0.5,
            'max' => $this->area * 1.5
        ];

        $priceRange = [
            'min' => $this->price * 0.5,
            'max' => $this->price * 1.5
        ];


       return  Ad::where('category_id', $this->category_id)
            ->whereBetween('area', [$areaRange['min'], $areaRange['max']])
            ->whereBetween('price', [$priceRange['min'], $priceRange['max']])
            ->where('id', '!=', $this->id)
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->limit(3)->get();
    }
}
