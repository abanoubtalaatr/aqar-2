<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules['name'] = [
            'required', 'required','min:2','max:100',
            Rule::unique('users', 'name')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })
        ];

        $rules['email'] = [
            'required',
            Rule::unique('users', 'email')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })
        ];

        $rules['phone'] = [
            'numeric', 'digits_between:8,11',
            Rule::unique('users', 'phone')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })
        ];

        $rules['password'] = 'required|min:8|max:50|confirmed';

        return $rules;
    }
}
