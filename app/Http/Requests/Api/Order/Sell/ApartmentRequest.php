<?php

namespace App\Http\Requests\Api\Order\Sell;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width_from' => ['nullable'],
            'street_width_to' => ['nullable'],
            'property_age_from' => ['nullable'],
            'property_age_to' => ['nullable'],

            'purpose' => ['nullable'],
            'floor_number' => ['nullable'],
            'number_of_rooms' => ['nullable'],
            'number_of_halls' => ['nullable'],
            'number_of_bathrooms' => ['nullable'],

            'furnished' => ['nullable','boolean'],
            'elevator' => ['nullable', 'boolean'],
            'number_of_floors' => ['nullable']
        ];
    }
}
