<?php

namespace App\Http\Requests\Api\RentByDayOrMonth;

use Illuminate\Foundation\Http\FormRequest;

class FurnishedApartmentRequest extends FormRequest
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
                'pool' => ['nullable','boolean'],
                'property_age' => ['nullable'],
                'number_of_living_rooms' => ['nullable'],
                'floor_number' => ['required'],
                'number_of_bathrooms' => ['required'],
                'number_of_rooms' => ['required'],
                'elevator' => ['nullable','boolean'],
                'water_supply' => ['nullable','boolean'],
                'electricity_supply' => ['nullable','boolean'],
                'sewerage_supply' => ['nullable','boolean'],
        ];
    }
}
