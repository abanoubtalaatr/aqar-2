<?php

namespace App\Http\Requests\Api\AdSell;

use Illuminate\Foundation\Http\FormRequest;

class RoomSellRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'floor_number' => 'required|integer',
            'furnished' => 'nullable|boolean',
            'water_supply' => 'nullable|boolean',
            'electricity_supply' => 'nullable|boolean',
            'sewerage_supply' => 'nullable|boolean',

        ];
    }
}
