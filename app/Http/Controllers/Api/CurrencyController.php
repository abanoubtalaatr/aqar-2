<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CurrencyResource;
use App\Models\Currency;
use App\Traits\GeneralTrait;

class CurrencyController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $currencies = Currency::get();
        $currencies_data = CurrencyResource::collection($currencies);

        return $this->returnData('data', $currencies_data);
    }
}
