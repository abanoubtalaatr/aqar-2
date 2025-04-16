<?php

namespace App\Http\Requests\Api\Order\Rent;

use Illuminate\Foundation\Http\FormRequest;

class FurnishedApartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'for_rent' => ['required', 'in:1'],
            'renting_duration' => ['nullable'],
            'street_width_from' => ['nullable', 'integer'],
            'street_width_to' => ['nullable', 'integer'],
            'property_age_from' => ['nullable', 'integer'],
            'property_age_to' => ['nullable', 'integer'],

            'purpose' => ['nullable'],
            'floor_number' => ['nullable'],
            'number_of_rooms' => ['nullable'],
            'number_of_living_rooms' => ['nullable'],
            'number_of_bathrooms' => ['nullable'],

            'elevator' => ['nullable', 'boolean'],
            'description' => ['nullable']
        ];
    }
}
