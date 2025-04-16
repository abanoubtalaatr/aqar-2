<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RandomMessage;
use App\Services\General\FormatPrice;
use App\Services\General\FavoriteService;
use App\Services\General\FollowingService;
use App\Http\Services\NameContestantService;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => __('mobile.required').' ' . ((string) $this->category?->name . ' ' . ($this->for_rent == 0 ? __('mobile.for_sell') : __('mobile.for_rent'))),
            'category_name' => __('mobile.required').' ' . ((string) $this->category?->name . ' ' . ($this->for_rent == 0 ? __('mobile.for_sell') : __('mobile.for_rent'))),
            'views_count' => (string) ($this->views_count ?? 0),
            'saved_count' => (string) $this->favoriteCount(),
            'is_golden' => (bool) $this->is_golden,
            'category_id' => $this->category?->id ?? "",
            'category' => SimpleCategoryResource::make($this->category),
            'price' => (string) FormatPrice::format($this->price_from),
            'format_price_from' => number_format($this->price_from, 0, ',', ','),
            'format_price_to' => number_format($this->price_to, 0, ',', ','),
            'map_price_from' => (string) FormatPrice::format($this->price_from),
            'map_price_to' => (string) FormatPrice::format($this->price_to),
            'price_from' => (string) $this->price_from,
            'price_to' => (string) $this->price_to,
            'area_from' => (string) $this->area_from,
            'area_to' => (string) $this->area_to,
            'length' => (string) $this->length,
            'width' => (string) $this->width,
            'property_age' => (string) $this->property_age_from,
            'property_age_from' => (string) $this->property_age_from,
            'property_age_to' => (string) $this->property_age_to,
            'street_width_from' => (string)($this->street_width_from ?? ''),
            'street_width_to' => (string)($this->street_width_to ?? ''),
            'description' => (string) $this->description,
            'map_latitude' => (string) $this->map_latitude,
            'map_longitude' => (string) $this->map_longitude,
            'address' => (string) $this->map_address,
            'face_building' => $this->face_building_id
                ? $this->faceBuilding->{'name_' . app()->getLocale()}
                : "",
            'published_at' => (string) Carbon::parse($this->published_at)->diffForHumans(),
            'user' => $this->user ? LoginResource::make($this->user)->additional([
                'favoritable_user_id' => $this->user_id ?? null, // Ensure favoritable relationship is loaded
            ]) : [],
            'my_order' => auth()->check() && $this->user_id === auth('api')->id(),

            'published_at' => str_replace('منذ ', '', (string) Carbon::parse($this->published_at)->diffForHumans()),
            'created_at' =>  Carbon::parse($this->created_at)->format("Y-m-d"),
            'last_updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),

            'is_updated' => (bool) $this->is_updated,
            'is_following' => auth()->check() ? (bool) FollowingService::isFollow(auth()->id()) : false,

            'is_saved' => FavoriteService::isFavorited($this->id, "Order"),
            'face_building_id' => (string) ($this->face_building_id ?? ""),
            'random_messages' => RandomMessageResource::collection(
                RandomMessage::where('is_active', true)->inRandomOrder()->limit(1)->get()
            ),
            'chat_id' => (string) $this->chatWithUser($this->id)?->chat_id,
            'renting_duration' => (string) $this->renting_duration,
            'renting_duration_name' => $this->renting_duration
            ? (string) NameContestantService::getRentDurationName($this->renting_duration)
            : "",
                    'number_of_floors' => (string) ($this->orderable?->number_of_floors ?? ""),
            'number_of_elevators' => (string) ($this->orderable?->number_of_elevators ?? ""),
            'meter_price' => (string) ($this->orderable?->meter_price ?? ""),
            'meter_price_from' => (string) ($this->orderable?->meter_price_from ?? ""),
            'meter_price_to' => (string) ($this->orderable?->meter_price_to ?? ""),
            'format_meter_price' => number_format($this->orderable?->meter_price, 0, ',', ','),
            'format_meter_price_to' => number_format($this->orderable?->meter_price_to, 0, ',', ','),
            'format_meter_price_from' => number_format($this->orderable?->meter_price_from, 0, ',', ','),
            'age_property' => (string) ($this->orderable?->age_property ?? ""),
            'height' => (string) ($this->orderable?->height ?? ""),
            'number_of_living_rooms' => (string) ($this->orderable?->number_of_living_rooms ?? ""),

            //extra fields
            'in_villa' => (bool) ($this->orderable->in_villa ?? false),
            'sewerage_supply' => (bool) ($this->orderable->sewerage_supply ?? false),
            'private_roof' => (bool) ($this->orderable->private_roof ?? false),
            'electricity_supply' => (bool) ($this->orderable->electricity_supply ?? false),
            'water_supply' => (bool) ($this->orderable->water_supply ?? false),
            'air_conditioner' => (bool) ($this->orderable->air_conditioner ?? false),
            'car_entrance' => $this->orderable?->car_entrance ? true : false,
            'elevator' => (bool) ($this->orderable->elevator ?? false),
            'has_elevator' => (bool) ($this->orderable->has_elevator ?? false),
            'private_entrance' => (bool) ($this->orderable->private_entrance ?? false),
            'kitchen' => (bool) ($this->orderable->kitchen ?? false),
            'furnished' => (bool) ($this->orderable->furnished ?? false),
            'driver_room' => (bool) ($this->orderable->driver_room ?? false),
            'air_conditioner' => (bool) ($this->orderable->air_conditioner ?? false),
            'maid_room' => (bool)($this->orderable->maid_room ?? false),
            'swimming_pool' => (bool) ($this->orderable->swimming_pool ?? false),
            'families_or_singles' => $this->orderable->families_or_singles ?? '',
            'basement' => (bool) ($this->orderable->basement ?? false),
            'living_room_stairs' => (bool) ($this->orderable->living_room_stairs ?? false),
            'verse' => (bool) ($this->orderable->verse ?? false),
            'is_cellar' => (bool)($this->orderable->is_cellar ?? false),
            'has_cellar' => (bool)($this->orderable->has_cellar ?? false),
            'has_interior_staircase' => (bool) ($this->orderable?->has_interior_staircase ? true : false),
            'is_equipped' => (bool) ($this->orderable->is_equipped ?? false),

            'is_rented' => (bool) ($this->orderable->is_rented ?? false),
            'furnished' => (bool) ($this->orderable->furnished ?? false),
            'is_offices' => (bool) ($this->orderable->is_offices ?? false),
            'pool' => (bool)($this->orderable->pool ?? ''),

            'length_belongs_to_specific' => (string) ($this->orderable->length ?? ''),
            'width' => (string) ($this->orderable->width ?? ''),
            'number_of_shops' => (string) ($this->orderable->number_of_shops_from ?? ''),
            'number_of_shops_from' => (string) ($this->orderable->number_of_shops_from ?? ''),
            'number_of_shops_to' => (string) ($this->orderable->number_of_shops_to ?? ''),
            'number_of_apartments_from' => (string) ($this->orderable->number_of_apartments_from ?? ''),
            'number_of_apartments_to' => (string) ($this->orderable->number_of_apartments_to ?? ''),
            'has_elevator' => (string) ($this->orderable->has_elevator ?? ''),
            'number_of_trees' => (string)($this->orderable->number_of_trees ?? ''),
            'number_of_wells' => (string)($this->orderable->number_of_wells ?? ''),
            'number_of_rooms' => (string) ($this->orderable->number_of_rooms ?? ''),
            'number_of_rooms_to' => (string) ($this->orderable->number_of_rooms_to ?? ''),
            'number_of_units_from' => (string)($this->orderable->number_of_units_from ?? ''),
            'number_of_units_to' => (string)($this->orderable->number_of_units_to ?? ''),
            'number_of_halls' => (string)($this->orderable->number_of_halls ?? ''),
            'number_of_apartments' => (string)($this->orderable->number_of_apartments ?? ''),
            'number_of_bathrooms' => (string)($this->orderable->number_of_bathrooms ?? ''),
            'purpose_id' => (string) ($this->orderable?->purpose ?? ""),
            'purpose' => (string) (isset($this->orderable?->purpose) ? NameContestantService::getPurposeName($this->orderable->purpose) : ""),
            'purpose_title' => (string) (isset($this->orderable?->purpose) ? NameContestantService::getPurposeTitle($this->orderable->purpose) : ""),
            'purpose_icon_name' => (string) (isset($this->orderable?->purpose) ? NameContestantService::getPurposeIconNumber($this->orderable->purpose) : ""),

            'street_width' => (string)($this->street_width_from ?? ''),
            'number_of_living_rooms' => (string)($this->orderable?->number_of_living_rooms ?? ''),
            'floor_number' => (string)($this->orderable?->floor_number ?? ''),
            'two_entrance' => (string)($this->orderable?->two_entrance ?? ''),
            'has_attached' => $this->orderable?->has_attached ? true : false,
            'visited_before' => $this->visits->contains('user_id', auth()->id()),
        ];
    }
}
