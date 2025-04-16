<?php

namespace App\Http\Requests\Api;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChatRequest extends FormRequest
{
    use GeneralTrait;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message' => ['required_without_all:files'],
            'files' => ['array', 'required_without_all:message'],
            'files.*' => ['file'], // Validate each file in the array
            'chat_id' => ['required', 'exists:chats,id'],
            'receiver_id' => ['required', 'exists:users,id'],
        ];
    }

    public function messages()
    {
        return [
            'ad_id.required' => __("mobile.Ad id is required")
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnValidationError(400, $validator));
    }
}
