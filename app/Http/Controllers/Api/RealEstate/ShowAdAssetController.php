<?php

namespace App\Http\Controllers\Api\RealEstate;

use App\Models\Ad;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FileResource;
use App\Services\General\FormatFileService;

class ShowAdAssetController extends Controller
{
    use GeneralTrait;
    public function show(Ad $real_estate)
    {
        $images = $real_estate->files->where('type', 0);
        $data['images'] = FormatFileService::formatFileIfModel(FileResource::collection($images)->collection);

        $videos = $real_estate->files->where('type', 1);
        $data['videos'] = FormatFileService::formatFileIfModel(FileResource::collection($videos)->collection);

        return $this->returnData('data', $data);
    }
}
