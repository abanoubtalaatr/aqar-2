<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChoiceResource extends JsonResource
{
    protected $index;

    public function __construct($resource, $index)
    {
        parent::__construct($resource);
        $this->index = $index;
    }

    public function toArray(Request $request): array
    {
        return [
            'index' => $this->index,
            'value' => $this->value,
        ];
    }
}
