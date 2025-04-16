<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        $rules = [];
        $rules['email'] = 'required|email|exists:users,email';
        // $rules['mobile'] = 'required|exists:users|digits:' . (Constants::MOBILE_LENGTH) . '|starts_with:' . Constants::STARTS_WITH;
        $rules['password'] = 'required|min:6|max:100';
        return $rules;
    }

    public function messages()
    {
        return [
            'email.exists' => __('Email  is not registered!'),
            'mobile.exists' => __('The selected mobile is invalid'),
            // 'mobile.digits' => __('The mobile must be 10 digits'),
            // 'mobile.starts_with' => __('The mobile must starts with one of the following: 05'),
            'password.min' => __('Password must be at least 6 characters')
        ];
    }
}
