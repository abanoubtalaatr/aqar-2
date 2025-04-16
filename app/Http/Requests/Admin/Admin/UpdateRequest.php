<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $rules['name'] = [
            'required',  'required','min:2','max:100',
        ];

        $rules['email'] = [
            'required',
            Rule::unique('users', 'email')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($this->admin),
        ];

        $rules['phone'] = [
            'numeric', 'digits_between:8,11',
            Rule::unique('users', 'phone')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($this->admin),
        ];

        $rules['role_id'] = 'nullable';
        if ($this->password && $this->password_confirmation) {
            $rules['password'] = 'min:8|max:50|confirmed';
            $rules['password_confirmation'] = 'min:8|max:50';
        }

        return $rules;
    }
}
