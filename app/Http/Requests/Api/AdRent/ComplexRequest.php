<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class ComplexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width_from' => ['required', 'integer'],
            'street_width_to' => ['required', 'integer'],
            'property_age_from' => ['required', 'integer'],
            'property_age_to' => ['required', 'integer'],
            'number_of_shops_from' => ['required', 'integer'],
            'number_of_shops_to' => ['required', 'integer'],
            'number_of_units_from' => ['required', 'integer'],
            'number_of_units_to' => ['required', 'integer'],
            'face_building_id' => ['nullable'],
            'purpose' => ['required'],
        ];
    }
}
