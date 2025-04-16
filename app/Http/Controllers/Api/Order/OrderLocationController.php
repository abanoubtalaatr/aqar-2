<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Order;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SimpleOrderResource;
use App\Http\Requests\Api\RealState\LocationRequest;

class OrderLocationController extends Controller
{
    use GeneralTrait;
    public function __invoke(LocationRequest $request, Order $order)
    {
        $data = $request->validated();

        $order->updateOrFail($data);

        // if (RequestUserAgentService::getUserAgent($request) == 'web') {
        //     return $this->returnData('data', SimpleOrderResource::make($order->refresh()), __("web.Updated successfully."));
        // }

        return $this->returnData('data', SimpleOrderResource::make($order->refresh()), __("mobile.Updated successfully."));
    }
}
