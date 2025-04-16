<?php

namespace App\Http\Requests\Api\Order\Rent;

use Illuminate\Foundation\Http\FormRequest;

class VillaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'for_rent' => ['required', 'in:1'],
            'renting_duration' => ['nullable'],
            'number_of_apartments' => ['nullable'],
            'number_of_rooms' => ['nullable'],
            'number_of_living_rooms' => ['nullable'],
            'number_of_bathrooms' => ['nullable'],
            'purpose' => ['nullable'],
            'face_building_id' => ['nullable'],
            'street_width_from' => ['nullable', ],
            'street_width_to' => ['nullable', ],
            'property_age_from' => ['nullable'],
            'property_age_to' => ['nullable'],
            'furnished' => ['nullable','boolean'],
            'car_entrance' => 'nullable|boolean',
            'has_interior_staircase' => ['nullable', 'boolean'],
            'elevator' => ['nullable', 'boolean'],
            'has_attached' => ['nullable', 'boolean'],
            'swimming_pool' => ['nullable', 'boolean'],
            'maid_room' => ['nullable', 'boolean'],
            'driver_room' => ['nullable', 'boolean'],
            'kitchen' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string']
        ];
    }
}
