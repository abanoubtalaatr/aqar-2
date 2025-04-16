<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class VillaSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'length' => 'required_if:for_rent,1',
            'width' => 'required_if:for_rent,1',
            'street_width' => 'required|integer',
            'duplex' => 'nullable|boolean',
            'purpose' => 'nullable',
            'number_of_apartments' => 'nullable',
            'number_of_bathrooms' => 'required',

            'number_of_rooms' => 'required',
            'number_of_halls' => 'required',

            'has_interior_staircase' => 'nullable|boolean',
            'furnished' => 'nullable|boolean',
            'kitchen' => 'nullable|boolean',
            'car_entrance' => 'nullable|boolean',

            'elevator' => 'nullable|boolean',
            'has_attached' => 'nullable|boolean',
            'swimming_pool' => 'nullable|boolean',
            'driver_room' => 'nullable|boolean',
            'maid_room' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',

            'playground' => 'nullable|boolean',
            'air_conditioner' => 'nullable|boolean',
            'attachment' => 'nullable|boolean',
            'has_cellar' => 'nullable|boolean',
        ];
    }
}
