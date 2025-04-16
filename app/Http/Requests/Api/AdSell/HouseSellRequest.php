<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class HouseSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width' => 'required|integer',
            'number_of_rooms' => 'required|integer',
            'number_of_living_rooms' => 'required|integer',
            'number_of_bathrooms' => 'required|integer',

            'renting_duration' => 'nullable|in:0,1,2',

            // additional
            'kitchen' => 'nullable|boolean',
            'furnished' => 'nullable|boolean',
            'driver_room' => 'nullable|boolean',
            'maid_room' => 'nullable|boolean',
            'verse' => 'nullable|boolean',
            'attachment' => 'nullable|boolean',
            'car_entrance' => 'nullable|boolean',
            'playground' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
        ];
    }
}
