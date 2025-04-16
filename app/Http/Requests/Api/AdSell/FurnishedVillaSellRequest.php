<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class FurnishedVillaSellRequest extends FormRequest
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

                    // additional
                    'kitchen' => 'nullable|boolean',
                    'amusement_park_games' => 'nullable|boolean',
                    'air_conditioner' => 'nullable|boolean',
                    'driver_room' => 'nullable|boolean',
                    'maid_room' => 'nullable|boolean',
                    'swimming_pool' => 'nullable|boolean',
                    'attachment' => 'nullable|boolean',
                    'car_entrance' => 'nullable|boolean',
                    'elevator' => 'nullable|boolean',
                    'basement' => 'nullable|boolean',
                    'living_room_stairs' => 'nullable|boolean',
                    'verse' => 'nullable|boolean',
                    'water_supply' => 'nullable|boolean',
                    'electricity_supply' => 'nullable|boolean',
                    'sewerage_supply' => 'nullable|boolean',
                    'duplex' => 'nullable|boolean',
                    'playground' => 'nullable|boolean',
                    'families_or_singles' => 'nullable|in:0,1,2',
        ];
    }
}
