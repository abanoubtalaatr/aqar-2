<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Ad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Order\ChangePublishedAtOrderRequest;

class ChangePublishedAtOrderController extends Controller
{
    public function __invoke(ChangePublishedAtOrderRequest $request, Ad $ad)
    {

    }
}
