<?php

namespace App\Http\Controllers\Api\RealEstate;

use App\Models\Ad;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RealState\LocationRequest;

class LocationController extends Controller
{
    use GeneralTrait;

    public function __invoke(LocationRequest $request, $id)
    {
        $ad = Ad::find($id);

        $data = $request->validated();

        if ($ad) {
            $ad->update($data);

            return $this->returnSuccessMessage(__('api.Ad updated successfully.'));
        }

        return $this->returnError(400, __('api.Ads not found.'));
    }
}
