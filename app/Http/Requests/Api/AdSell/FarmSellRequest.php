<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class FarmSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width' => 'required|integer',
            'number_of_wells' => 'nullable|integer',

            // additional

            'water_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
        ];
    }
}
