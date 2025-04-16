<?php

namespace App\Http\Resources\Web;

use App\Models\Category;
use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HousesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $keys = Key::where('category_id', Category::where('key', 'house')->first()->id)->get();
        // return [$this->interface];
        foreach ($keys as $key) {
            if ($this->{$key->attribute_name} != 0 && $key->name != 'property_age') {
                array_push($data, ['name' => $key->name, 'attribute_name' => $key->attribute_name, 'type' => $key->type, 'attribute_value' => $this->{$key->attribute_name}]);

            }
        }

        return $data;
        // return [
        //     'interface' => $this->interface,
        //     "street_width" => $this->street_width,
        //     "number_of_rooms" => $this->number_of_rooms,
        //     "number_of_living_rooms" => $this->number_of_living_rooms,
        //     "number_of_bathrooms" => $this->number_of_bathrooms,
        //     "property_age" => $this->property_age,
        //     "furnished" => $this->furnished,
        //     "kitchen" => $this->kitchen,
        //     "attachment" => $this->attachment,
        //     "car_entrance" => $this->car_entrance,
        //     "water_supply" => $this->water_supply,
        //     "electricity_supply" => $this->electricity_supply,
        //     "sewerage_supply" => $this->sewerage_supply,
        //     "driver_room" => $this->driver_room,
        //     "maid_room" => $this->maid_room,
        //     "verse" => $this->verse,
        //     "playground" => $this->playground,
        // ];
    }
}
