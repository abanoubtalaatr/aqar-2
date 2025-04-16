<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules['title_ar'] = 'required|min:2|max:100';
        $rules['title_en'] = 'required|min:2|max:100';
        $rules['page_ar'] = 'required|min:2';
        $rules['page_en'] = 'required|min:2';
        return $rules;
    }
}
