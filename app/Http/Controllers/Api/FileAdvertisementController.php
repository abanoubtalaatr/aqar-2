<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Models\File;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Traits\FileManagementTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FileRequest;
use App\Services\CheckFileLimitationService;
use App\Services\General\FormatFileService;
use App\Services\UploadFileForAdService;

/**
 * Class FileManagementController
 * @package App\Http\Controllers\Api
 */
class FileAdvertisementController extends Controller
{
    use GeneralTrait;
    use FileManagementTrait;


    public function store(FileRequest $request, $id, UploadFileForAdService $uploadFileForAdService)
    {
        $ad = Ad::find($id);

        $result = (new CheckFileLimitationService())->check($request, $ad);

        if ($result['status'] == false) {
            return $this->returnError(400, $result['message']);
        }
        $type = 0;


        if ($result['file_type'] == 'image') {
            $type = 0;
            File::where('ad_id', $ad->id)->where('type', 1000)->delete();
        } else {
            $type = 1;
        }

        if ($ad) {
            $file = $uploadFileForAdService->upload($request, $ad, $type);

            $data =  FormatFileService::formatFileIfModel($file);

            return $this->returnData('data', $data, __('mobile.added successfully.'));
            // return $this->returnData('data', $file, __('mobile.added successfully.'));
        }

        return $this->returnSuccessMassage(__('mobile.not found.'));
    }

    /**
     * Remove a file from the server
     * @param Request $request
     * @param File $file
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, File $file)
    {
        // Remove the file from the server
        $this->remove_file($file->path);

        // Remove the file from the database
        $file->delete();

        // Return a success message
        return $this->returnSuccessMessage(__('mobile.Deleted successfully.'));
    }
}
