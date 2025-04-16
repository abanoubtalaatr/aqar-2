<?php

namespace App\Http\Requests\Api\Order\Rent;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */

    public function rules(): array
    {
        return [
            'renting_duration' => ['nullable'],
            'floor_number' => ['nullable'],
            'has_elevator' => ['nullable', 'boolean'],
            'description' => ['nullable']
        ];
    }
}

//change
