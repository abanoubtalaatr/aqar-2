<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class ChaletRentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'price' => ['required'],
            'area' => ['required'],
            'renting_duration' => ['required'],
            'street_width' => ['nullable'],
            'property_age' => ['nullable'],
            'face_building_id' => ['nullable'],
            'pool' => ['nullable'],
            'description' => ['nullable'],
        ];
    }
}
