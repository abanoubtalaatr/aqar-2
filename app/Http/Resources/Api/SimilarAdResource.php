<?php

namespace App\Http\Resources\Api;

use App\Models\City;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimilarAdResource extends JsonResource
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

        return [
            'id' => $this->id,
            'name' => optional($this->category)->name.$this->for_rent_val.__('dashboard.in').optional($this->neighborhood)->name.' '.__('dashboard.in').optional($this->neighborhood->city)->name,
            'for_rent' => $for_rent,
            'for_rent_id' => $this->for_rent,
            'renting_duration_id' => $renting_duration,            'ad_number' => $this->ad_number,
            'views_count' => $this->views_count,
            'is_fav' => $this->is_favourite,
            'is_active' => $this->is_active,
            'is_star' => $this->stared,
            'category_id' => $this->category->id,
            'category_name' => $this->category->name,
            'license_number' => $this->license_number,
            'price' => $this->price,
            'last_updated' => $this->updated_at->diffForHumans(),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'currency_id' => $this->currency_id,
            'currency_name' => $this->currency->name,
            'neighborhood_id' => optional($this->neighborhood)->id,
            'neighborhood_name' => optional($this->neighborhood)->name,
            // 'city_id' => optional($this->neighborhood->city)->id,
            // 'city_name' => optional($this->neighborhood->city)->name,
            // 'country_id' => optional($this->neighborhood->city->country)->id,
            // 'country_name' => optional($this->neighborhood->city->country)->name,
            'area' => $this->area,
            'length' => $this->length,
            'width' => $this->width,
            'property_age' => $this->property_age,
            'advertiser_relationship_with_property' => $this->advertiser_relationship_with_property,
            'description' => $this->description,
            'map_latitude' => $this->map_latitude,
            'map_longitude' => $this->map_longitude,
            'user' => new ProfileResource($this->user),
            'images' => FileResource::collection($this->files->where('type', 0)),
            'videos' => FileResource::collection($this->files->where('type', 1)),
            'ad_details' => $this->adableResource(),
            'ad_filters' => new AdFilterResource($this),
        ];
    }

    public function adableResource()
    {
        switch ($this->category_id) {
            case 1:
                return new ApartmentResource($this->adable);
            case 2:
                return new BuildingsResource($this->adable);
            case 3:
                return new ChaletsResource($this->adable);
            case 4:
                return new FloorsResource($this->adable);
            case 5:
                return new HallsResource($this->adable);
            case 6:
                return new CampsResource($this->adable);
            case 7:
                return new RoomsResource($this->adable);
            case 8:
                return new FarmsResource($this->adable);
            case 9:
                return new LandsResource($this->adable);
            case 10:
                return new FurnishedApartmentsResource($this->adable);
            case 11:
                return new CommercialOfficesResource($this->adable);
            case 12:
                return new RestsResource($this->adable);
            case 13:
                return new ShopsResource($this->adable);
            case 14:
                return new HousesResource($this->adable);
            case 15:
                return new VillasResource($this->adable);
            case 16:
                return new WarehousesResource($this->adable);
            case 17:
                return new FurnishedVillasResource($this->adable);
            case 18:
                return new StudiosResource($this->adable);
            default:

                break;
        }
        // .....
    }
}
