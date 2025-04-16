<?php

namespace App\Http\Controllers\Api\RealEstate;

use Exception;
use App\Models\Ad;
use App\Constants\AdStatus;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\RandomImageForAdService;
use App\Http\Requests\Api\RealState\LicenseNumberRequest;

class LicenseNumberController extends Controller
{
    use GeneralTrait;

    protected RandomImageForAdService $randomImageService;

    public function __construct(RandomImageForAdService $randomImageService)
    {
        $this->randomImageService = $randomImageService;
    }

    public function __invoke(LicenseNumberRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $data['status'] = AdStatus::ACTIVE;

            $ad = Ad::create($data);

            $this->randomImageService->generate($ad);

            return $this->returnData('ad', $ad, __('mobile.Ad created successfully.'));
        } catch (Exception) {
            return $this->returnError(400, __('mobile.Error Try again in another time please'));
        }

    }
}
