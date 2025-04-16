<?php

namespace App\Http\Requests\Api\Order\Sell;

use Illuminate\Foundation\Http\FormRequest;

class buildingRequest extends FormRequest
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
            'face_building_id' => ['nullable'],

            'number_of_shops_from' => ['nullable'],
            'number_of_shops_to' => ['nullable'],
            'number_of_apartments_from' => ['nullable'],
            'number_of_departments_to' => ['nullable'],
            'has_cellar' => ['nullable','boolean'],
            'has_elevator' => ['nullable', 'boolean'],
            'number_of_floors' => ['nullable']
        ];
    }
}
