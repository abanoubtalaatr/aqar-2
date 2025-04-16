<?php

namespace App\Http\Controllers\Api\RealEstate;

use App\Models\Ad;
use App\Constants\AdStatus;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;

class MakeAdDraftedController extends Controller
{
    use GeneralTrait;
    public function __invoke(Ad $ad)
    {
        $ad->update(['status' => AdStatus::DRAFT]);

        return $this->returnSuccessMessage(__("mobile.Ad updated successfully."));
    }
}
