<?php

namespace App\Http\Requests\Api\Order\Rent;

use Illuminate\Foundation\Http\FormRequest;

class LandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'for_rent' => ['required', 'in:1'],
            'face_building_id' => ['nullable'],
            'purpose' => ['nullable',],
            'number_of_floors' => ['nullable']
        ];
    }
}
