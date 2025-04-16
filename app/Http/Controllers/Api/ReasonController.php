<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ReasonResource;

class ReasonController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $reasons = \App\Models\Reason::all();

        return $this->returnData('data', ReasonResource::collection($reasons));
    }
}
