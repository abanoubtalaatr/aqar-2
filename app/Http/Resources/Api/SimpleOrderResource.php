<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\General\FormatPrice;
use App\Services\General\FollowingService;
use App\Http\Services\NameContestantService;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleOrderResource extends JsonResource
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
            'name' => "مطلوب " . ((string) $this->category?->name . ' ' . ($this->for_rent == 0 ? 'للبيع' : 'للايجار')),
            'category_name' => "مطلوب " . ((string) $this->category?->name . ' ' . ($this->for_rent == 0 ? 'للبيع' : 'للايجار')),
            'views_count' => (string) ($this->views_count ?? 0),
            'saved_count' => (string) $this->favoriteCount(),
            'per_day_or_month' => (bool) $this->per_day_or_month,
            'is_golden' => (bool) $this->is_golden,
            'category_id' => $this->category?->id ?? "",
            'category' => SimpleCategoryResource::make($this->category),
            'price' => (string) FormatPrice::format($this->price_from),
            'map_price_from' => (string) FormatPrice::format($this->price_from),
            'map_price_to' => (string) FormatPrice::format($this->price_to),
            'price_from' => (string) $this->price_from,
            'price_to' => (string) $this->price_to,
            'area_from' => (string) $this->area_from,
            'area_to' => (string) $this->area_to,
            'length' => (string) $this->length,
            'width' => (string) $this->width,
            'property_age' => (string) $this->property_age,
            'description' => (string) $this->description,
            'map_latitude' => (string) $this->map_latitude,
            'map_longitude' => (string) $this->map_longitude,
            'address' => (string) $this->map_address,
            'face_building_id' => (string) $this->face_building_id,
            'published_at' => (string) Carbon::parse($this->published_at)->diffForHumans(),
            'renting_duration' => (string) $this->renting_duration,
            'street_width' => (string) ($this->orderable->street_width ?? ""),
            'floor_number' => (string) ($this->orderable->floor_number ?? ""),
            'purpose' => (string) ($this->orderable && $this->orderable->purpose
                ? NameContestantService::getPurposeName($this->orderable->purpose)
                : ""),
                'is_updated' => (bool) $this->is_updated,
                'is_following' => auth()->check() ? (bool) FollowingService::isFollow(auth()->id()) : false,

            'number_of_apartments' => (string) ($this->orderable->number_of_apartments ?? ""),
            'number_of_halls' => (string) ($this->orderable->number_of_halls ?? ""),
            'number_of_bathrooms' => (string) ($this->orderable->number_of_bathrooms ?? ""),
            'number_of_shops' => (string) ($this->orderable->number_of_shops ?? ""),
            'number_of_trees' => (string) ($this->orderable->number_of_trees ?? ""),
            'number_of_wells' => (string) ($this->orderable->number_of_wells ?? ""),
            'number_of_rooms' => (string) ($this->orderable->number_of_rooms ?? ""),
            'number_of_units' => (string) ($this->orderable->number_of_units ?? ""),
        ];
    }
}
