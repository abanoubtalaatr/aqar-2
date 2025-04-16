<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPassword extends FormRequest
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
        $rules['email'] = 'required|email|exists:users';
        return $rules;
    }

    public function messages()
    {
        return [
            'email.exists' => __('This user is not registered!'),
            'email.required' => __('Email required!'),
            'email.email' => __('Enter valid email!'),
        ];
    }

}
