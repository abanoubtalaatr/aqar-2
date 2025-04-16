<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules['name'] = 'required|min:2|max:100';
        $rules['user_id'] = 'required';
        $rules['price'] = 'required';
        $rules['hours'] = 'required';
        $rules['minutes'] = 'required';
        return $rules;
    }
}
