<?php

namespace App\Http\Requests\Api;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
{
    use GeneralTrait;

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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'not_regex:/^(012345|123456|234567|345678|456789|567890|678901|789012|890123|901234|543210|654321|765432|876543|987654|098765)$/',
                ],

            'verification_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'password.not_regex' => __("mobile.Please Enter valid password not contain sequence like this 123456.")
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnValidationError(400, $validator));
    }
}
