<?php

namespace App\Http\Resources\Api;

use App\Models\Category;
use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FarmsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $keys = Key::where('category_id', Category::where('key', 'farm')->first()->id)->get();
        foreach ($keys as $key) {
            if ($this->{$key->attribute_name} != 0 && $key->name != 'property_age') {
                array_push($data, ['name' => $key->name, 'attribute_name' => $key->attribute_name, 'type' => $key->type, 'attribute_value' => $this->{$key->attribute_name}]);

            }
        }

        return $data;
        // return [
        //     "street_width" => $this->street_width,
        //     "number_of_wells" => $this->number_of_wells,
        //     "number_of_trees" => $this->number_of_trees,
        //     "verse" => $this->verse,
        //     "water_supply" => $this->water_supply,
        //     "electricity_supply" => $this->electricity_supply,
        //     "sewerage_supply" => $this->sewerage_supply,
        //     "number_of_rooms" => $this->number_of_rooms,
        //     "number_of_living_rooms" => $this->number_of_living_rooms,
        //     "number_of_bathrooms" => $this->number_of_bathrooms,
        //     "kitchen" => $this->kitchen,
        //     "amusement_park_games" => $this->amusement_park_games,
        //     "car_entrance" => $this->car_entrance,
        //     "pool" => $this->pool,
        //     "football_field" => $this->football_field,
        //     "volleyball_field" => $this->volleyball_field,
        //     'families_or_singles' => $this->families_or_singles,
        //     'interface'=>$this->interface,
        // ];
    }
}
