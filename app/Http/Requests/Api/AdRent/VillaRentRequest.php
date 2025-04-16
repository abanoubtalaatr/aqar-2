<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class VillaRentRequest extends FormRequest
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
            'face_building_id' => ['required'],
            'renting_duration' => ['nullable'],
            'for_rent' => ['required', 'in:1'],
            'purpose' => ['nullable'],
            'number_of_apartments' => ['nullable'],
            'number_of_rooms' => ['required'],
            'number_of_halls' => ['required'],
            'number_of_bathrooms' => ['required'],
            'has_attached' => ['nullable'],
            'description' => ['nullable'],
            'furnished' => ['nullable', 'boolean'],
            'car_entrance' => ['nullable', 'boolean'],
            'has_interior_staircase' => ['nullable', 'boolean'],
            'has_cellar' => ['nullable', 'boolean'],
            'pool' => ['nullable', 'boolean'],
            'driver_room' => ['nullable', 'boolean'],
            'maid_room' => ['nullable', 'boolean'],
            'water_supply' => ['nullable', 'boolean'],
            'electricity_supply' => ['nullable', 'boolean'],
            'sewerage_supply' => ['nullable', 'boolean'],
        ];
    }
}
