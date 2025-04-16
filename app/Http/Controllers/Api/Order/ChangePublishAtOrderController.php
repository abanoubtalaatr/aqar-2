<?php

namespace App\Http\Controllers\Api\Order;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class ChangePublishAtOrderController extends Controller
{
    use GeneralTrait;

    public function __invoke(Request $request, Order $order)
    {
        $order->update(['published_at' => now(), 'is_updated' => 1, 'change_published_at' => now()]);

        return $this->returnData('data', __("mobile.Updated successfully."));
    }
}
