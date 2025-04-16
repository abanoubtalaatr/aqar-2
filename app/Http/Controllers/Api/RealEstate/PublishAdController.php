<?php

namespace App\Http\Controllers\Api\RealEstate;

use App\Models\Ad;
use App\Constants\AdStatus;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;

class PublishAdController extends Controller
{
    use GeneralTrait;
    public function __invoke(Ad $real_estate)
    {
        if ($real_estate) {
            $real_estate->updateOrFail(['status' => AdStatus::ACTIVE , 'published_at' => now()]);

            return $this->returnSuccessMessage(__('mobile.Published Ad Updated successfully.'));
        }
        return $this->returnSuccessMessage(__('mobile.not found.'), true, 422);
    }
}
