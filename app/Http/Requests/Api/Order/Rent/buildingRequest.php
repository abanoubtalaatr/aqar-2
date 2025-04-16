<?php

namespace App\Http\Requests\Api\Order\Rent;

use Illuminate\Foundation\Http\FormRequest;

class buildingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width_from' => ['nullable', 'integer'],
            'street_width_to' => ['nullable', 'integer'],
            'property_age_from' => ['nullable', 'integer'],
            'property_age_to' => ['nullable', 'integer'],

            'purpose' => ['nullable'],

            'number_of_shops_from' => ['nullable'],
            'number_of_shops_to' => ['nullable'],
            'number_of_apartments_from' => ['nullable'],
            'number_of_departments_to' => ['nullable'],
            'basement' => ['nullable','boolean'],
            'has_elevator' => ['nullable', 'boolean'],
            'description' => ['nullable'],
            'number_of_floors' => ['nullable']
        ];
    }
}
