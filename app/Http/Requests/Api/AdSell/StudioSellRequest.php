<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class StudioSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width' => 'required|integer',
                    'number_of_rooms' => 'required|integer',
                    'floor_number' => 'required|integer',
                    'number_of_living_rooms' => 'required|integer',
                    'number_of_bathrooms' => 'required|integer',

                    // additional
                    'kitchen' => 'nullable|boolean',
                    'furnished' => 'nullable|boolean',
                    'attachment' => 'nullable|boolean',
                    'elevator' => 'nullable|boolean',
                    'private_entrance' => 'nullable|boolean',
                    'two_entrance' => 'nullable|boolean',
                    'in_villa' => 'nullable|boolean',
                    'water_supply' => 'nullable|boolean',
                    'electricity_supply' => 'nullable|boolean',
                    'sewerage_supply' => 'nullable|boolean',
                    'air_conditioner' => 'nullable|boolean',
                    'families_or_singles' => 'nullable|in:0,1,2',
                    'private_roof' => 'nullable|boolean',
        ];
    }
}
