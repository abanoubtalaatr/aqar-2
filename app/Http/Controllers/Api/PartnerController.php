<?php

namespace App\Http\Controllers\Api;

use App\Models\Partner;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $partners = Partner::where('is_active', 1)->get();

        return $this->returnData('data', $partners);
    }
}
