<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'latitude' => $this->latitude ?? "",
            'longitude' => $this->longitude ?? "",
            'latitude_min' => $this->latitude_min ?? "",
            'latitude_max' => $this->latitude_max ?? "",
            'longitude_min' => $this->longitude_max ?? "",
            'longitude_max' => $this->longitude_max ?? "",
            'latitude_center' => $this->latitude_center ?? "",
            'longitude_center' => $this->longitude_center ?? ""
        ];
    }
}
