<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\General\FormatFileService;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'city' => CityResource::make($this->city),
            'title' => $this->title,
            'file' => FormatFileService::formatIfString($this->image, '/public/storage'),
            'description' => $this->description,
            'views' => rand(1, 200),
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('F d Y'),
            'updated_at' => Carbon::parse($this->updated_at)->translatedFormat('F d Y'),
        ];
    }
}
