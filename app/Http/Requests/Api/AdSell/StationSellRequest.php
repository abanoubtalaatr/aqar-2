<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class StationSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'face_building_id' => 'required|exists:face_buildings,id',
            'street_width' => 'required|integer',

            // additional
            'length' => 'nullable|integer',
            'width' => 'nullable|integer',
            'is_equipped' => 'nullable|boolean',
            'is_rented' => 'nullable|boolean',

            'water_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
        ];
    }
}
