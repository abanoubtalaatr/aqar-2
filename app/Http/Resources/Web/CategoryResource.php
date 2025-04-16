<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'max_rent_price' => $this->max_rent_price,
            'min_rent_price' => $this->min_rent_price,
            'max_sell_price' => $this->max_sell_price,
            'min_sell_price' => $this->min_sell_price,
        ];
    }
}
