<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width' => 'required|integer',
            'floor_number' => 'nullable',
            'number_of_rooms' => 'required',
            'number_of_halls' => 'required',
            'number_of_bathrooms' => 'required',
            'purpose' => 'nullable',
            'furnished' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',

            // this is old but i not remove it maybe the client want to added it later
            'families_or_singles' => 'nullable|in:0,1,2',
            'kitchen' => 'nullable|boolean',
            'two_entrance' => 'nullable|boolean',
            'private_roof' => 'nullable|boolean',
            'air_conditioner' => 'nullable|boolean',
            'attachment' => 'nullable|boolean',
            'car_entrance' => 'nullable|boolean',
            'elevator' => 'nullable|boolean',
            'private_entrance' => 'nullable|boolean',

        ];
    }
}
