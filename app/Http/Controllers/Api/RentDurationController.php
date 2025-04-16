<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\NameContestantService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class RentDurationController extends Controller
{
    use GeneralTrait;

    public function index(Request $request, NameContestantService $nameContestantService)
    {
        if ($request->has('rent_by_day') && $request->input('rent_by_day') == 1) {
            if ($request->has('all') && $request->input('all') == 1) {
                $data = $nameContestantService::rentDuration(true, 'all');
            } else {
                $data = $nameContestantService::rentDuration(true);
            }

        } else {
            if ($request->has('all') && $request->input('all') == 1) {
                $data = $nameContestantService::rentDuration(false, 'all');
            } else {
                $data = $nameContestantService::rentDuration(false);
            }

        }

        return $this->returnData('data', $data);
    }
}
