<?php

namespace App\Http\Requests\Api\RealState;

use App\Http\Requests\Api\RealState\ValidationDependOnCategory\Vila;
use Illuminate\Foundation\Http\FormRequest;

class RealStateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $additionalData = [];

        $initialData = [
            'category_id' => ['required', 'exists:categories,id'],
            'for_rent' => ['required', 'boolean'],
            'price' => ['required', 'min:1'],
            'area' => ['required', 'min:1'],
            'length' => ['required', 'min:1'],
            'width' => ['required', 'min:1'],
            'street_width' => ['required', 'min:1'],
            'building_age' => ['required'],
            'type' => ['required'], // clearifying,
            'department' => ['required'],
        ];

        //vila
        if ($this->category_id == 3) {
            $additionalData = (new Vila())->rules();
        }

        return array_merge($initialData, $additionalData);
    }
}
