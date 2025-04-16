<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class FloorRentRequest extends FormRequest
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
            'street_width' => ['required'],
            'property_age' => ['nullable'],
            'purpose' => ['nullable'],
            'face_building_id' => ['nullable'],
            'floor_number' => ['nullable'],
            'number_of_rooms' => ['required'],
            'number_of_halls' => ['nullable'],
            'number_of_bathrooms' => ['required'],
            'furnished' => ['nullable', 'boolean'],
            'elevator' => ['nullable', 'boolean'],
            'water_supply' => ['nullable', 'boolean'],
            'electricity_supply' => ['nullable', 'boolean'],
            'sewerage_supply' => ['nullable', 'boolean'],
        ];
    }
}
