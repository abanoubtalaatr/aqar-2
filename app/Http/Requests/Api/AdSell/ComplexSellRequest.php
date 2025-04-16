<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class ComplexSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width' => 'required|integer',
            'purpose' => 'required',
            'face_building_id' => 'required|exists:face_buildings,id',
            'property_age' => 'required',

            // additional
            'number_of_shops' => 'nullable',
            'number_of_units' => 'nullable|',
            'has_offices' => 'nullable|boolean',
            'has_cellar' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
        ];
    }
}
