<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class FloorSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width' => 'required|integer',
            'number_of_rooms' => 'required',
            'number_of_halls' => 'required',
            'number_of_bathrooms' => 'required',
            'floor_number' => 'nullable',
            'purpose' => 'nullable',

            // additional
            'furnished' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
            'elevator' => 'nullable|boolean',
        ];
    }
}
