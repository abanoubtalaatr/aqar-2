<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Models\City;
use App\Traits\GeneralTrait;

class CityController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        //kd
        $cities = City::where('is_for_landing_page_in_app', 1)->whereNotNull('latitude_center')->where('is_active', 1)->get();
        $cities = CityResource::collection($cities);

        return $this->returnData('data', $cities);
    }

    public function nibras()
    {
        //kd
        $cities = City::where('is_for_landing_page_in_app', 0)->where('is_active', 1)->get();
        $cities = CityResource::collection($cities);

        return $this->returnData('data', $cities);
    }

    public function allCities()
    {
        $cities = City::all();
        $cities_data = CityResource::collection($cities);

        return $this->returnData('data', $cities_data);
    }
}
