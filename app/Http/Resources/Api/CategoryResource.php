<?php

namespace App\Http\Resources\Api;

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
        $name = $this->name;
        $categoryName = __("");

        if ($request->has('for_sell') && $request->input('for_sell') == 1) {
            $categoryName = __("mobile.for_sell");
            if ($this->id == 6) {
                $categoryName = __("");

                $name = __('mobile.shop_for_kiss');
            }
        }

        if ($request->has('for_rent') && $request->input('for_rent') == 1) {
            $categoryName = __("mobile.for_rent");
            if ($this->id == 6) {
                $name = __('mobile.shop');
            }
        }

        if ($request->has("per_day_or_month") && $request->input("per_day_or_month") == 1) {
            $categoryName = __("mobile.for_rent");
        }

        if ($request->has('order_for_sell') && $request->input('order_for_sell') == 1) {
            $categoryName = __("mobile.for_sell");
            if ($this->id == 6) {
                $categoryName = __("");

                $name = __('mobile.shop_for_kiss');
            }
        }

        if ($request->has('order_for_rent') && $request->input('order_for_rent') == 1) {
            $categoryName = __("mobile.for_rent");
        }

        if ($this->type == 'sell') {
            $categoryName = __("mobile.for_sell");
            if ($this->id == 6) {
                $categoryName = __("");

            }
        }
        if ($this->type == 'rent') {
            $categoryName = __("mobile.for_rent");
            if ($this->id == 6) {
                $name = __("mobile.shop");
            }
        }

        return [
            'id' => $this->id,
            'name' =>  $name . ' ' . $categoryName ?? "",
            'type' => $this->type ?? "",

        ];
    }
}
