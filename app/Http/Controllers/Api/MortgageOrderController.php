<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\MortgageOrderRequest;
use App\Models\MortgageOrder;
use App\Traits\GeneralTrait;

class MortgageOrderController extends Controller
{
    use GeneralTrait;


    public function store(MortgageOrderRequest $request)
    {
        // return $request ;
        MortgageOrder::create($request->validated());

        return $this->returnSuccessMassage('success');
    }
}
