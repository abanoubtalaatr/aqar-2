<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KeyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'attribute_name' => $this->attribute_name,
            'type' => $this->type,
            // 'show_in_order' => $this->show_in_order,
            'is_required' => $this->getRawOriginal('is_required'),
            'choices' => $this->choices->map(function ($choice, $index) {
                return new ChoiceResource($choice, $index);
            }),
        ];
    }
}
