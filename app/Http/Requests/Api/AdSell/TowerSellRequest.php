<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class TowerSellRequest extends FormRequest
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
            'number_of_floors' => 'required',
            'number_of_elevators' => 'nullable',
            'water_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
            'has_cellar' => 'nullable|boolean',
        ];
    }
}
