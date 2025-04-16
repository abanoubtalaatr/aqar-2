<?php

namespace App\Http\Resources\Api;

use App\Models\Category;
use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $keys = Key::where('category_id', Category::where('key', 'apartment')->first()->id)->get();
        foreach ($keys as $key) {
            if ($key->name != 'property_age' && $this->{$key->attribute_name} != 0) {
                array_push($data, ['name' => $key->name, 'attribute_name' => $key->attribute_name, 'type' => $key->type, 'attribute_value' => $this->{$key->attribute_name}]);

            }
        }

        return $data;
        // return [
        //     "street_width" => $this->street_width,
        //     "number_of_rooms" => $this->number_of_rooms,
        //     "number_of_living_rooms" => $this->number_of_living_rooms,
        //     "number_of_bathrooms" => $this->number_of_bathrooms,
        //     "floor_number" => $this->floor_number,
        //     "property_age" => $this->property_age,
        //     "renting_duration" => $this->renting_duration,
        //     "furnished" => $this->furnished,
        //     "kitchen" => $this->kitchen,
        //     "attachment" => $this->attachment,
        //     "car_entrance" => $this->car_entrance,
        //     "elevator" => $this->elevator,
        //     "air_conditioner" => $this->air_conditioner,
        //     "water_supply" => $this->water_supply,
        //     "electricity_supply" => $this->electricity_supply,
        //     "sewerage_supply" => $this->sewerage_supply,
        //     "private_roof" => $this->private_roof,
        //     "in_villa" => $this->in_villa,
        //     "two_entrance" => $this->two_entrance,
        //     "private_entrance" => $this->private_entrance,
        //     "families_or_singles" => $this->families_or_singles,
        // ];
    }
}
