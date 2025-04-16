<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $imageRules = ['required', 'mimes:png,jpeg,png'];
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $imageRules = ['nullable', 'mimes:png,jpeg,png'];
        }
        return [
            'image' => $imageRules,
            'link' => ['nullable', 'url'],
            'description_ar' => ['nullable', 'string', 'min:3'],
            'description_en' => ['nullable', 'string', 'min:3'],
        ];
    }
}
