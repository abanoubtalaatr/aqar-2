<?php

namespace App\Http\Requests\Api\Order\Sell;

use Illuminate\Foundation\Http\FormRequest;

class ComplexRequest extends FormRequest
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
            'number_of_shops_from' => ['nullable'],
            'number_of_shops_to' => ['nullable'],
            'number_of_units_from' => ['nullable'],
            'number_of_units_to' => ['nullable'],
            'face_building_id' => ['nullable'],
            'purpose' => ['nullable'],
        ];
    }
}
