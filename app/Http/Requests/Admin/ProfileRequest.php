<?php

namespace App\Http\Requests\Admin;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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

    public function rules()
    {
        $rules['email'] = 'required|email|unique:users,email,' . auth()->id();
        // $rules['username'] = 'required|unique:users,username,' . auth()->id();
        $rules['name'] = 'required' ;
        $rules['mobile'] = 'required|digits:' . Constants::MOBILE_LENGTH
        . '|numeric|unique:users,mobile,' . auth()->id();
        $rules['photo'] = 'file|mimes:jpg,bmp,png';

        if ($this->password || $this->old_password) {
            $rules['old_password'] = 'required|string|min:6';
            $rules['password'] = 'required|string|min:6|confirmed';
            $rules['password_confirmation'] = 'required|string|min:6';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            // 'email.required' => __('Email required!'),
            // 'email.email' => __('Enter valid email!'),
            // 'national_id.numeric' => __('National ID should be numbers only!'),
            // 'national_id.digits' => __('National ID should be consists of ') . Constants::NationalID_LENGTH . __(' number!'),
        ];
    }
}
