<?php

namespace App\Services;

use App\Http\Requests\Api\FileRequest;
use App\Models\Ad;
use App\Models\File;
use App\Traits\FileManagementTrait;

class UploadFileForAdService
{
    use FileManagementTrait;

    protected $imageWatermarkService;

    public function __construct(ImageWatermarkService $imageWatermarkService)
    {
        $this->imageWatermarkService = $imageWatermarkService;
    }

    public function upload(FileRequest $request, Ad $ad, $fileType = null)
    {
        // Upload the file first
        $filePath = $this->upload_file($request->file('file'), 'Ad');

        // If it's an image (type 0), add watermark with very low opacity (10%)
        if ($fileType === 0) {
            $radom = rand(0,100);
            $this->imageWatermarkService->addWatermark($filePath, 'images/watermarks/watermark.png', $radom);
        }

        // Create the file entry after validation passes
        $file = File::create([
            'path' => $filePath,
            'description' => "",
            'ad_id' => $ad->id,
            'type' => $fileType
        ]);

        return $file;
    }
}
