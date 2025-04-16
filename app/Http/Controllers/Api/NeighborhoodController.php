<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mobile\NeighborhoodResource;
// use App\Http\Resources\Mobile\NeighborhoodResource;
use App\Models\City;
use App\Traits\GeneralTrait;

class NeighborhoodController extends Controller
{
    use GeneralTrait;

    public function index($city_id)
    {
        $city = City::find($city_id);
        // return $this->returnData('data', $city);
        if ($city) {
            $neighborhood = $city->neighborhoods;
            $neighborhood_data = NeighborhoodResource::collection($neighborhood);

            return $this->returnData('data', $neighborhood_data);
        } else {
            return $this->returnError('404', __('site.not found.'));
        }
    }
}
