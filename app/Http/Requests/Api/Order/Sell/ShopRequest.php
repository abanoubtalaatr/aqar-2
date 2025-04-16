<?php

namespace App\Http\Requests\Api\Order\Sell;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to category 1.
     */
    public function rules(): array
    {
        return [
            'street_width_from' => ['nullable'],
            'street_width_to' => ['nullable'],
        ];
    }
}
