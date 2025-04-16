<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
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
            'type' => $this->type,
            'details' => $this->whenLoaded('favoritable', function () {
                if ($this->favoritable_type === 'App\\Models\\Order') {
                    return new OrderResource($this->favoritable);
                }

                if ($this->favoritable_type === 'App\\Models\\Ad') {
                    return new SimpleAdResource($this->favoritable);
                }

                return '';
            }),
        ];
    }
}
