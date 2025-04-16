<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class ComplexRentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'renting_duration' => ['nullable'],
            'for_rent' => ['required', 'in:1'],

            'price' => ['required'],
            'area' => ['required'],
            'face_building_id' => ['nullable'],
            'street_width' => ['required'],
            'property_age' => ['required'],
            'number_of_shops' => ['nullable'],
            'number_of_units' => ['nullable'],
            'purpose' => ['required'],
            'has_offices' => ['nullable', 'boolean'],
            'has_cellar' => ['nullable', 'boolean'],

            'water_supply' => ['nullable', 'boolean'],
            'electricity_supply' => ['nullable', 'boolean'],
            'sewerage_supply' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string']
        ];
    }
}
