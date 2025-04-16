<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class BuildingSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'purpose' => 'required',
            'street_width' => 'required|integer',
            'number_of_apartments' => 'nullable',
            'number_of_shops' => 'nullable',

            // additional
            'furnished' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'has_elevator' => 'nullable|boolean',
        ];
    }
}
