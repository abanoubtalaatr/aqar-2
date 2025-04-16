<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules['old_password'] = 'required|string|min:6';
        $rules['password'] = 'required|string|min:6|confirmed';
        $rules['password_confirmation'] = 'required|string|min:6';
        return $rules;
    }
}
