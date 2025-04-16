<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class CampSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'renting_duration' => 'nullable|in:0, 1, 2',

            // additional
            'family_area' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
        ];
    }
}
