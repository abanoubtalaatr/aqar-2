<?php

namespace App\Http\Requests\Api\Order\Sell;

use Illuminate\Foundation\Http\FormRequest;

class LandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'face_building_id' => ['nullable'],
            'price_meter_from' => ['nullable'],
            'price_meter_from' => ['nullable'],
            'street_width_from' => ['nullable'],
            'street_width_to' => ['nullable'],
            'number_of_floors' => ['nullable']
        ];
    }
}
