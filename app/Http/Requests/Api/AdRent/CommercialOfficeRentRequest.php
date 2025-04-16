<?php

namespace App\Http\Requests\Api\AdRent;

use Illuminate\Foundation\Http\FormRequest;

class CommercialOfficeRentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'property_age' => 'required',
            'street_width' => 'required',

            'room_of_numbers' => 'nullable',
            'sewerage_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'purpose' => 'nullable',
            'has_offices' => 'nullable|boolean',
        ];
    }
}
