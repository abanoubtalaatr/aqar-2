<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Order;
use App\Traits\GeneralTrait;
use App\Constants\OrderStatus;
use App\Http\Controllers\Controller;

class MakeOrderUnDraftController extends Controller
{
    use GeneralTrait;
    public function __invoke(Order $order)
    {
        $order->update(['status' => OrderStatus::ACTIVE]);

        return $this->returnSuccessMessage(__("mobile.Order updated successfully."));
    }
}
