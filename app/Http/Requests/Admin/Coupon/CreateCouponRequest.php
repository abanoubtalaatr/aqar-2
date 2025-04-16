<?php

namespace App\Http\Requests\Admin\Coupon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $couponId = $this->route('coupon'); // Assuming your route parameter is named 'coupon'
        $uniqueRule = ($this->isMethod('post')) ? 'unique:coupons,code' : Rule::unique('coupons', 'code')->ignore($couponId);

        return [
            'name' => ['required', 'min:2'],
            'code' => [
                'required',
                'min:2',
                $uniqueRule,
            ],
            'start_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'type' => ['required', 'in:percentage,value'],
            'max_users' => ['required'],
            'min_order_amount' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'start_date.after_or_equal' => __('The :attribute must be a date after or equal to today.'),
            'end_date.after' => __('End Date must be after today', ['attribute' => __('end date')]),
        ];
    }
}
