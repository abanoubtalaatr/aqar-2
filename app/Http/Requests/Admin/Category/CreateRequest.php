<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        foreach (config('general.languages') as $lang => $language) {
            $rules['name.'.$lang] = 'required|min:2|max:40';
        }
        $rules['image'] = 'file|mimes:jpg,bmp,png';

        return $rules;
    }
}
