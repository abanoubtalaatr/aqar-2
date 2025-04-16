<?php

namespace App\Http\Requests\Api\RealState\ValidationDependOnCategory;

class Vila
{
    public function rules(): array
    {
        return [
            'field1' => ['required', 'string'],
            'field2' => ['required', 'numeric'],
            // Add more validation rules specific to 'Vila'
        ];
    }
}
