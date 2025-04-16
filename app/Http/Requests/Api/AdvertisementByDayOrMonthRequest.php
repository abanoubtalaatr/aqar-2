<?php

namespace App\Http\Requests\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Api\RentByDayOrMonth\AdRentByDayOrMonthRuleFactory;

class AdvertisementByDayOrMonthRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        $additional_data = [
            'per_day_or_month' => 1,
            'category_id' => ['required', 'exists:categories,id']
        ];

        $data =  $additional_data = AdRentByDayOrMonthRuleFactory::getRulesForCategory($request->category_id);

        return array_merge($data, $additional_data);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnValidationError(400, $validator));
    }
}
