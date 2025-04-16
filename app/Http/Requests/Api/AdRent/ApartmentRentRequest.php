<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required'],
            'area' => ['required'],
            'street_width' => ['required'],
            'property_age' => ['nullable'],
            'purpose' => ['nullable'],
            'renting_duration' => ['nullable'],
            'for_rent' => ['required', 'in:1'],
            'floor_number' => ['nullable'],
            'number_of_rooms' => ['required'],
            'number_of_halls' => ['required'],
            'number_of_bathrooms' => ['required'],
            'furnished' => ['nullable', 'boolean'],
            'elevator' => ['nullable', 'boolean'],

            'water_supply' => ['nullable', 'boolean'],
            'electricity_supply' => ['nullable', 'boolean'],
            'sewerage_supply' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string']
        ];
    }
}
