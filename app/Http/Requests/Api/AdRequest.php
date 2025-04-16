<?php

namespace App\Http\Requests\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Api\AdRent\AdRentRuleFactory;
use App\Http\Requests\Api\AdSell\AdSellRuleFactory;

class AdRequest extends FormRequest
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
     * This method defines and returns the validation rules for the advertisement request,
     * tailored to the specific type of advertisement being created or updated. The rules
     * are dynamically generated based on the type of advertisement (rent, sell, or rent
     * by day or month) and the category of the property (e.g., room, building, etc.).
     *
     * The validation criteria ensure that the required fields are provided, and that the
     * values conform to the expected formats and constraints. For instance, when creating
     * an advertisement for renting a room, specific fields are mandatory that may differ
     * from those required when selling a property. This adaptability is achieved by
     * utilizing dedicated rule factories for each advertisement type, which encapsulate
     * the unique validation requirements for different property categories.
     *
     * In summary, this function:
     * - Validates fundamental advertisement attributes, including pricing, area, and
     *   category association.
     * - Integrates additional validation rules based on the advertisement type and
     *   selected category.
     * - Ensures that the request adheres to the established business logic and data
     *   integrity requirements.
     *

     *هنا ف الكلاس دا كل نوع بيبقي ليه الفليديشن الخاصه بيه، انا عندي انواع كتير من الاعلانات منها ما هو بيع وما هو شراء وما هو اجار باليوم او الشهر
     *وكل نوع ليه الفيلدس الخاصه بيه مثال انا لو عايز اجر شقه الفيلدس الل مطلوبه مختلفه عن الفيلدس لو انا هبيع شقه
     * ف انا لو عملت كل الفليديشن هنا الملف كان هيعدي ١٠٠٠ سطر كود ف، بتالي انا عامل فاكتوري لكل نوع علشان يسهل الفليدشن ولو غيرت ف مكان ما يآثرش علي باقي الامكان
     * @return array The array of validation rules applicable to the request.
     */

    public function rules(Request $request): array
    {
        $additional_data = [];

        $data = [
            'for_rent' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'area' => 'required|integer',
            'length' => 'nullable|integer',
            'width' => 'nullable|integer',
            'currency_id' => 'nullable|exists:currencies,id',
            'advertiser_relationship_with_property' => 'nullable|in:0,1,2',
            'description' => 'nullable|string',
            'map_latitude' => 'nullable',
            'map_longitude' => 'nullable',
            'property_age' => 'nullable',
            'neighborhood_id' => 'nullable|exists:neighborhoods,id',
            'files' => 'nullable|array',
            'files.description' => 'nullable|string',
            'renting_duration' => 'nullable',

            'face_building_id' => 'nullable|exists:face_buildings,id',
            'advertiser_owner' => 'nullable|boolean',
            'is_debt' => 'nullable|boolean',
            'bound_for_sale' => 'nullable|boolean',
            'is_golden' => 'nullable|boolean',
        ];

        if ($request->has('for_rent') && $request->for_rent == 1 || $request->for_rent == '1') { // Rules if you add ads in case rent
            $additional_data = AdRentRuleFactory::getRulesForCategory($request->category_id);
        } else {
            $additional_data = AdSellRuleFactory::getRulesForCategory($request->category_id);
        }

        return array_merge($data, $additional_data);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnValidationError(400, $validator));
    }
}
