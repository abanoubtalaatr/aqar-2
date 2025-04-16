<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
