<?php

namespace App\Http\Requests\Api\RentByDayOrMonth;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'for_rent' => ['required'],
            'renting_duration' => ['required'],
            'floor_number' => ['nullable'],
            'elevator' => ['nullable', 'boolean'],
            'furnished' => ['nullable', 'boolean'],
            'water_supply' => ['nullable', 'boolean'],
            'electricity_supply' => ['nullable', 'boolean'],
            'sewerage_supply' => ['nullable', 'boolean'],
        ];
    }
}
