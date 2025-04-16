<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\NameContestantService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class PurposeController extends Controller
{
    use GeneralTrait;

    public function index(Request $request, NameContestantService $nameContestantService)
    {
        $all = $request->has('all') && $request->input('all') == 1 ? true : false;
        return $this->returnData('data', $nameContestantService::purposesDependOnType($request->type, $all));
    }
}
