<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class FurnishedApartmentSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'property_age' => 'required',
            'street_width' => 'required|integer',
            'floor_number' => 'required|integer',
            'number_of_rooms' => 'required|integer',
            'number_of_living_rooms' => 'required|integer',
            'number_of_bathrooms' => 'required|integer',

            // additional

            'elevator' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',

        ];
    }
}
