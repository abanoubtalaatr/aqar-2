<?php

namespace App\Services;

use App\Http\Requests\Api\FileRequest;
use App\Models\Ad;
use App\Models\File;
use App\Traits\FileManagementTrait;
use App\Traits\GeneralTrait;
use Illuminate\Support\Str;

class CheckFileLimitationService
{
    use FileManagementTrait;
    use GeneralTrait;

    public function check(FileRequest $request, Ad $ad)
    {
        // Get the MIME type of the file and determine if it's an image or video
        $fileMimeType = $request->file('file')->getMimeType();
        $fileType = $this->determineFileType($fileMimeType);

        // Check file limits based on the type
        $checkResult = $this->checkFileLimits($ad, $fileType);
        if ($checkResult !== true) {
            return [
                'status' => false,
                'message' => $checkResult,
                'file_type' => $fileType
            ];
        }
        return [
            'status' => true,
            'message' => '',
            'file_type' => $fileType
        ];
    }

    // Method to determine the file type based on MIME
    private function determineFileType($mimeType)
    {
        if (Str::startsWith($mimeType, 'image/')) {
            return 'image';
        } elseif (Str::startsWith($mimeType, 'video/')) {
            return 'video';
        }

        // Return an error message instead of throwing an exception
        abort(400, 'Invalid file type');
    }

    // Method to check file limits
    private function checkFileLimits(Ad $ad, $fileType)
    {
        $maxImages = env('MAX_IMAGES', 10);
        $maxVideos = env('MAX_VIDEOS', 3);

        if ($fileType === 'image' && $ad->files()->where('type', 'image')->count() >= $maxImages) {
            return __('mobile.You can only upload up to ' . $maxImages . ' images.');
        }

        if ($fileType === 'video' && $ad->files()->where('type', 'video')->count() >= $maxVideos) {
            return __('mobile.You can only upload up to ' . $maxVideos . ' videos.');
        }

        return true; // No issues
    }
}
