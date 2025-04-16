<?php

namespace App\Http\Requests\Api\RentByDayOrMonth;

use Illuminate\Foundation\Http\FormRequest;

class HallRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'for_rent' => ['required'],
            'renting_duration' => ['required'],
            'street_width' => 'nullable',
            'property_age' => 'nullable',
            'kitchen' => ['nullable', 'boolean'],
            'furnished' => ['nullable', 'boolean'],
        ];
    }
}
