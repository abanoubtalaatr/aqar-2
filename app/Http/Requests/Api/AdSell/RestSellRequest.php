<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class RestSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'length' => 'required_if:for_rent,0',
            'width' => 'required_if:for_rent,0',
            'face_building_id' => 'required|exists:face_buildings,id',
            'street_width' => 'required',

            // additional

            'sewerage_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'pool' => 'nullable|boolean',
            'kitchen' => 'nullable|boolean',
        ];
    }
}
