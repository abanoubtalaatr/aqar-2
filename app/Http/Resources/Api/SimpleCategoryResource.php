<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $type = '';
        if ($request->filled('show_word_sell_or_rent') && $request->input('show_word_sell_or_rent') == '1') {
            $type = ($request->filled('for_rent') && $request->input('for_rent') == '1') || ($request->filled('per_day_or_month') && $request->input('per_day_or_month') == '1')
                ? 'rent'
                : ($request->filled('for_sell') && $request->input('for_sell') == '1'
                    ? 'sell'
                    : '');
            $type  =  __('mobile.' . $type);
        }


        return [
            'id' => is_array($this->resource) ? $this->resource['id'] : $this->resource->id,
            'name' => is_array($this->resource) ? $this->resource['name'] : $this->resource->name . ' ' . $type,
        ];
    }
}
