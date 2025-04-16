<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CountryResource;
use App\Models\Country;
use App\Traits\GeneralTrait;

class CountryController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $countries = Country::get();
        $countries_data = CountryResource::collection($countries);

        return $this->returnData('data', $countries_data);
    }
}
