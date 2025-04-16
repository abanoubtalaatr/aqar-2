<?php

namespace App\Http\Controllers\Api\RealEstate;

use App\Models\Ad;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Services\RandomImageForAdService;
use App\Http\Requests\Api\AdvertisementByDayOrMonthRequest;
use App\Services\AdCreationService;
use App\Services\Builders\AdCreationBuilder;

class AdvertisementByDayOrMonthController extends Controller
{
    use GeneralTrait;

    public function store(AdvertisementByDayOrMonthRequest $request)
    {
        // Here we are using Builder pattern to handle complex creation of object of model (Ad)

        $ad = new AdCreationBuilder();

        $ad = $ad->setCategory($request->category_id)
            ->setAdData($request)
            ->createAdableEntity($request)
            ->create();

        if (!$ad) {
            return $this->returnError('mobile.Ad creation failed.', 400);
        }

        (new RandomImageForAdService())->generate($ad);

        return $this->returnData('data', $ad, __('mobile.Ad created successfully.'));
    }


    public function update(AdvertisementByDayOrMonthRequest $request, $ad)
    {
        $ad = Ad::find($ad);

        if (!$ad) {
            return $this->returnError('mobile.Ads not found.', 400);
        }

        $ad = (new AdCreationService())->updateAdWithAdable($ad->id, $request);

        return $this->returnData('data', $ad, __('mobile.Ad updated successfully.'));
    }
}
