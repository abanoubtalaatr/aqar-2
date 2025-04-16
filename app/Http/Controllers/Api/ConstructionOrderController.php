<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ConstructionOrderRequest;
use App\Models\ConstructionOrder;
use App\Traits\GeneralTrait;

class ConstructionOrderController extends Controller
{
    //
    use GeneralTrait;

    public function store(ConstructionOrderRequest $request)
    {
        if ($data = ConstructionOrder::create($request->validated())) {
            return $this->returnSuccessMassage('success');
        } else {
            return $this->returnErrorMassage('error');
        }
    }
}
