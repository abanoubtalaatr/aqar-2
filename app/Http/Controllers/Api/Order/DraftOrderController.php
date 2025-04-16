<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Filters\OrderFilters;
use App\Constants\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Traits\GeneralTrait;

class DraftOrderController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        $query = Order::query()->where('user_id', auth()->id())->where('status', OrderStatus::DRAFT);

        $orders = (new OrderFilters($request))->apply($query)->paginate(6);

        return $this->returnData('data', OrderResource::collection($orders));
    }
}
