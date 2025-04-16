<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules['permissions'] = "required";


        $rules["name"] = [
            'required',
            'min:4',
            'max:40',
            Rule::unique('roles', 'name')->ignore($this->role->id),
        ];

        $rules["name_ar"] = [
            'required',
            'min:4',
            'max:40',
            Rule::unique('roles', 'name_ar')->ignore($this->role->id),
        ];
        return $rules;
    }
}
