<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Models\User;
use App\Models\Setting;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RealEstateIndexController extends Controller
{
    use GeneralTrait;
    public function __invoke(Request $request)
    {
        $visits = Ad::sum('views_count');
        $adsCount = Ad::where('is_active', 1)->count();
        $settings = Setting::where('key', 'download_number')->first();

        $numberOfDownload = $settings->download_number ??  1000;

        $tradingValue = Ad::sum('price');


        $data = [
          'visits' => $visits,
          'number_of_download' => $numberOfDownload,
          'trading_value' => $tradingValue,
          'users' => User::doesntHave('roles')->count(),
          'adsCount' => $adsCount,
        ];

        return $this->returnData('data', $data);
    }
}
