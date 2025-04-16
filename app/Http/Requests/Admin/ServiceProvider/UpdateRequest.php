<?php

namespace App\Http\Requests\Admin\ServiceProvider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules['name'] = [
            'required',  'required','min:2','max:100',
            Rule::unique('users', 'name')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($this->id),
        ];

        $rules['email'] = [
            'required',
            Rule::unique('users', 'email')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($this->id),
        ];

        $rules['mobile'] = [
            'numeric', 'digits_between:8,10',
            Rule::unique('users', 'mobile')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($this->id),
        ];

        $rules['photo'] = 'file|mimes:jpg,bmp,png';
        // $rules['category_id'] = 'required|exists:categories,id';
        $rules['gender'] = '';
        $rules['type'] = 'in:3,4,6';
        $rules['lat'] = 'required';
        $rules['lng'] = 'required';
        $rules['location'] = 'required';
        if ($this->password && $this->password_confirmation) {
            $rules['password'] = 'min:8|max:50|confirmed';
            $rules['password_confirmation'] = 'min:8|max:50';
        }

        return $rules;
    }

}
