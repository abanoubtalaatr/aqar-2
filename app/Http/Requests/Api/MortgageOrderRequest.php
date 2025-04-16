<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MortgageOrderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'have_personal_finance' => 'required|boolean',
            'eligible_for_support' => 'required|boolean',
            'arabic_date' => 'required|boolean',
            'date_of_birth' => 'required|date',
            'salary' => 'required|integer',
            'monthly_Commitments' => 'required|integer',
            'job' => 'required|string',
        ];
    }
}
