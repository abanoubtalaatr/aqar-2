<?php

namespace App\Http\Requests\Api;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Api\Order\Sell\CategorySellRuleFactory;
use App\Http\Requests\Api\Order\Rent\CategoryRentRuleFactory;

class OrderRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $baseRules = [
            'for_rent' => 'required|in:0,1,2',
            'category_id' => 'required|exists:categories,id',
            'price_from' => 'required|integer',
            'price_to' => 'required|integer',
            'street_width_from' => 'nullable|integer',
            'street_width_to' => 'nullable|integer',
            'area_from' => 'required|integer',
            'area_to' => 'required|integer',
            'description' => 'nullable|string',
            'has_files' => 'nullable|boolean',
            'renting_duration' => 'nullable',
        ];

        if ($this->for_rent == 0) {
            $categoryRules = CategorySellRuleFactory::getRulesForCategory($this->category_id);
            return array_merge($baseRules, $categoryRules);
        } else {
            $categoryRules = CategoryRentRuleFactory::getRulesForCategory($this->category_id);
            return array_merge($baseRules, $categoryRules);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnValidationError(400, $validator));
    }
}
