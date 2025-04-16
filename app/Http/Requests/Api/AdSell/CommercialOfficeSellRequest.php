<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class CommercialOfficeSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'property_age' => 'required|integer',
            'street_width' => 'required|integer',

            'room_of_numbers' => 'nullable|integer',
            'sewerage_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'purpose' => 'nullable'
        ];
    }
}
