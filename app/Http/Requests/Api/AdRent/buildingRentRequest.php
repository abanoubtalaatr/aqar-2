<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class buildingRentRequest extends FormRequest
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
            'property_age' => ['required'],
            'purpose' => ['required'],
            'number_of_rooms' => ['nullable'],
            'renting_duration' => ['nullable'],
            'for_rent' => ['required', 'in:1'],
            'face_building_id' => ['nullable'],
            'number_of_shops' => ['nullable'],
            'number_of_apartments' => ['nullable'],
            'has_cellar' => ['nullable', 'boolean'],
            'has_elevator' => ['nullable', 'boolean'],
            'water_supply' => ['nullable', 'boolean'],
            'electricity_supply' => ['nullable', 'boolean'],
            'sewerage_supply' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string']
        ];
    }
}
