<?php

namespace App\Http\Controllers\Api;

use App\Models\License;
use App\Traits\GeneralTrait;
use App\Traits\FileManagementTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\LicenseResource;
use App\Http\Requests\Api\LicenseUserRequest;

class LicenseController extends Controller
{
    use GeneralTrait;
    use FileManagementTrait;

    public function index()
    {
        $licenses = License::with('user')->paginate(10);
        return $this->returnData('data', LicenseResource::collection($licenses));
    }

    public function store(LicenseUserRequest $request)
    {
        $data = $request->except('file');
        $data['user_id'] = auth()->id();

        if ($request->has('file')) {
            $data['file'] = $this->upload_file($request['file'], 'licenses');
        }
        $licenseExists = License::where('user_id', auth()->id())->where('type', $request->type)->where('status', License::STATUS_PENDING)->first();

        if ($licenseExists) {
            return $this->returnError(400, __("mobile.you have license still pending"));
        }

        $license = License::create($data);

        return $this->returnData('data', [], __('mobile.created successfully.'));
    }

    public function show(License $license)
    {
        return $this->returnData('data', new LicenseResource($license));
    }

    public function update(LicenseUserRequest $request, License $license)
    {
        if ($request->user_id != $license->user_id) {
            return $this->returnError(403, __('mobile.unauthorized'));
        }
        $data = $request->except('file');

        if ($request->has('file')) {
            $this->delete_file($license->file);
            $data['file'] = $this->upload_file($request['file'], 'licenses');
        }

        $license->update($data);

        return $this->returnData('data', new LicenseResource($license), __('mobile.updated successfully.'));
    }

    public function destroy(License $license)
    {
        $license->delete();

        return $this->returnSuccessMessage(__('mobile.deleted successfully.'));
    }
}
