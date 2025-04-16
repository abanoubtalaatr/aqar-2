<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class HallSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width' => 'required|integer',
            'face_building_id' => 'required|exists:face_buildings,id',

            // additional
            'kitchen' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
        ];
    }
}
