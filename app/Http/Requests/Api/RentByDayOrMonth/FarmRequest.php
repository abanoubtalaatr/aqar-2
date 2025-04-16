<?php

namespace App\Http\Requests\Api\RentByDayOrMonth;

use Illuminate\Foundation\Http\FormRequest;

class FarmRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'for_rent' => ['required'],
            'renting_duration' => ['required'],
            'street_width' =>  ['nullable'],
            'number_of_wells' => ['nullable'],
            'water_supply' => ['nullable', 'boolean'],
            'electricity_supply' => ['nullable', 'boolean'],
            'sewerage_supply' => ['nullable', 'boolean'],
        ];
    }
}
