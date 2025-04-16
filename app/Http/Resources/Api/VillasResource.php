<?php

namespace App\Http\Resources\Api;

use App\Models\Category;
use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VillasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $keys = Key::where('category_id', Category::where('key', 'villa')->first()->id)->get();
        foreach ($keys as $key) {
            if ($this->{$key->attribute_name} != 0 && $key->name != 'property_age') {
                array_push($data, ['name' => $key->name, 'attribute_name' => $key->attribute_name, 'type' => $key->type, 'attribute_value' => $this->{$key->attribute_name}]);

            }
        }

        return $data;
        // return [
        //     'interface' => $this->interface,
        //     "street_width" => $this->street_width,
        //     "basement" => $this->basement,
        //     "air_conditioner" => $this->air_conditioner,
        //     "number_of_rooms" => $this->number_of_rooms,
        //     "number_of_apartments" => $this->number_of_apartments,
        //     "number_of_living_rooms" => $this->number_of_living_rooms,
        //     "number_of_bathrooms" => $this->number_of_bathrooms,
        //     "property_age" => $this->property_age,
        //     "living_room_stairs" => $this->living_room_stairs,
        //     "driver_room" => $this->driver_room,
        //     "maid_room" => $this->maid_room,
        //     "swimming_pool" => $this->swimming_pool,
        //     "furnished" => $this->furnished,
        //     "verse" => $this->verse,
        //     "playground" => $this->playground,
        //     "kitchen" => $this->kitchen,
        //     "attachment" => $this->attachment,
        //     "car_entrance" => $this->car_entrance,
        //     "elevator" => $this->elevator,
        //     "duplex_" => $this->duplex_,
        //     "water_supply" => $this->water_supply,
        //     "electricity_supply" => $this->electricity_supply,
        //     "sewerage_supply" => $this->sewerage_supply,
        // ];
    }
}
