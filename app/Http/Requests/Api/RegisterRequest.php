<?php

namespace App\Http\Requests\Api;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|unique:users,email',
            'password' => [
                'required',
                // 'confirmed',
                'string',
                'min:6',
                'not_regex:/^(012345|123456|234567|345678|456789|567890|678901|789012|890123|901234|543210|654321|765432|876543|987654|098765)$/',
                'confirmed'
            ],

            'device_id' => 'nullable',
        ];
    }

    //min : 6 number and not sequence and have char

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
