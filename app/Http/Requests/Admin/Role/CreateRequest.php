<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Validation\Rule;
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
        $rules['permissions'] = "required";

        $rules["name"] = [
            'required',
            'min:4',
            'max:40',
            Rule::unique('roles', 'name')->ignore($this->id),
        ];

        $rules["name_ar"] = [
            'required',
            'min:4',
            'max:40',
            Rule::unique('roles', 'name_ar')->ignore($this->id),
        ];
        return $rules;
    }

}
