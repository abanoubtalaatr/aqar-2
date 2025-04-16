<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class StationRentRequest extends FormRequest
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
            'face_building_id' => ['nullable'],
            'is_equipped' => ['nullable', 'boolean'],

            'water_supply' => ['nullable', 'boolean'],
            'electricity_supply' => ['nullable', 'boolean'],
            'sewerage_supply' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string']
        ];
    }
}
