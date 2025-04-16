<?php

namespace App\Http\Requests\Api\Order\Sell;

use Illuminate\Foundation\Http\FormRequest;

class TowerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width_from' => ['nullable'],
            'street_width_to' => ['nullable'],
            'property_age_from' => ['nullable'],
            'property_age_to' => ['nullable'],
            'floor_number_from' => ['nullable'],
            'floor_number_to' => ['nullable'],
            'number_of_elevators_from' => ['nullable'],
            'number_of_elevators_to' => ['nullable'],
            'has_cellar' => ['nullable', 'boolean']

        ];
    }
}
