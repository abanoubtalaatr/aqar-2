<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class FurnishedApartmentRentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'property_age' => 'nullable',
            'street_width' => 'nullable',
            'floor_number' => 'nullable',
            'number_of_rooms' => 'required',
            'number_of_halls' => 'required',
            'number_of_bathrooms' => 'required',
            'purpose' => ['nullable'],

            // additional

            'elevator' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
        ];
    }
}
