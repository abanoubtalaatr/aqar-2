<?php

namespace App\Http\Resources\Web;

use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        // return [$this->category];
        // return [$this->neighborhood];
        return [
            'id' => $this->id,
            'name' => optional($this->category)->name.$this->for_rent_val.__('dashboard.in').optional($this->neighborhood)->name.' '.__('dashboard.in').optional($this->neighborhood->city)->name,
            'price_from' => $this->price_from,
            'price_to' => $this->price_to,
            'similar_ads_number' => Ad::where('neighborhood_id', $this->neighborhood->id)->where('category_id', $this->category_id)->where('for_rent', $this->for_rent)->count(),
            'currency_id' => $this->currency_id,
            'currency_name' => $this->currency->name,
            'order_details' => $this->orderableResource(),

            'for_rent' => $this->for_rent,
            // 'ad_number' => $this->ad_number,
            // 'views_count' => $this->views_count,
            // 'is_fav' => $this->is_favourite,
            // 'is_active' => $this->is_active,
            // 'is_star' => $this->stared,
            'category_id' => $this->category->id,
            'category_name' => $this->category->name,
            // 'license_number' => $this->license_number,
            // 'last_updated' => $this->updated_at->diffForHumans(),
            // 'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'neighborhood_id' => optional($this->neighborhood)->id,
            // 'neighborhood_name' => optional($this->neighborhood)->name,
            // 'city_id' => optional($this->neighborhood->city)->id,
            // 'city_name' => optional($this->neighborhood->city)->name,
            // 'country_id' => optional($this->neighborhood->city->country)->id,
            // 'country_name' => optional($this->neighborhood->city->country)->name,
            // 'area' => $this->area,
            // 'length' => $this->length,
            // 'width' => $this->width,
            // 'property_age' => $this->property_age,
            // 'advertiser_relationship_with_property' => $this->advertiser_relationship_with_property,
            // 'description' => $this->description,
            // 'map_latitude' => $this->map_latitude,
            // 'map_longitude' => $this->map_longitude,
            // 'user' => new ProfileResource($this->user),
            // 'images' => FileResource::collection($this->files->where('type', 0)),
            // 'videos' => FileResource::collection($this->files->where('type', 1)),
            // 'ad_filters' =>  new AdFilterResource($this),
            // 'ad_filters_all' =>  new AllAdFilterResource($this),
            // 'similar_ads' =>  $this->SimilarAds(),

        ];
    }

    public function orderableResource()
    {
        switch ($this->category_id) {
            case 1:
                return new ApartmentResource($this->orderable);
            case 2:
                return new BuildingsResource($this->orderable);
            case 3:
                return new ChaletsResource($this->orderable);
            case 4:
                return new FloorsResource($this->orderable);
            case 5:
                return new HallsResource($this->orderable);
            case 6:
                return new CampsResource($this->orderable);
            case 7:
                return new RoomsResource($this->orderable);
            case 8:
                return new FarmsResource($this->orderable);
            case 9:
                return new LandsResource($this->orderable);
            case 10:
                return new FurnishedApartmentsResource($this->orderable);
            case 11:
                return new CommercialOfficesResource($this->orderable);
            case 12:
                return new RestsResource($this->orderable);
            case 13:
                return new ShopsResource($this->orderable);
            case 14:
                return new HousesResource($this->orderable);
            case 15:
                return new VillasResource($this->orderable);
            case 16:
                return new WarehousesResource($this->orderable);
            case 17:
                return new FurnishedVillasResource($this->orderable);
            case 18:
                return new StudiosResource($this->orderable);
            default:

                break;
        }
        // .....
    }
}
