<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Order;
use App\Traits\GeneralTrait;
use App\Constants\OrderStatus;
use App\Http\Controllers\Controller;

class PublishOrderController extends Controller
{
    use GeneralTrait;
    public function __invoke(Order $order)
    {
        $order->updateOrFail(['status' => OrderStatus::ACTIVE, 'published_at' => now()]);

        return $this->returnSuccessMessage(__('mobile.Published Order Updated successfully.'));
    }
}
