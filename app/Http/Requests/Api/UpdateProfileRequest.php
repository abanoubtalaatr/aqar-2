<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
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
        $user = JWTAuth::user();

        return [
            'avatar' => 'nullable|image',
            'name' => 'nullable|string',
            'email' => [
                'nullable',
                'string',
                'email',
                'unique:users,email,' . $user->id, // Ignore the current user ID for uniqueness check
            ],
            'about' => 'nullable|string',
            'membership_type' => 'nullable|string',
            'phone' => [
                'nullable',
                Rule::unique('users', 'phone')->ignore($user->id),
            ],
            'old_password' => 'nullable',
            'new_password' => 'nullable|confirmed|different:old_password|required_with:old_password',
            'marketing_license' => 'nullable|url',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnValidationError(400, $validator));
    }
}
