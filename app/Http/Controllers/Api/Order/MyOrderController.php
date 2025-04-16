<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Filters\OrderFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Traits\GeneralTrait;

class MyOrderController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        $query = Order::query()->where('user_id', auth()->id());

        $filters = new OrderFilters($request);

        $query = $filters->apply($query);

        $orders = $request->has('paginate') && $request->input('paginate') == 1 ? $query->paginate() : $query->get();

        if ($request->has('paginate') && $request->input('paginate') == 1) {
            $ads_data = OrderResource::collection($orders)->response()->getData();
        } else {
            $ads_data = OrderResource::collection($orders);
        }

        return $this->returnData('data', $ads_data);
    }
    public function show(Order $my_order)
    {
        $this->authorize('show', $my_order);

        return $this->returnData('data', $my_order);
    }

    public function destroy(Order $my_order)
    {
        $this->authorize('delete', $my_order);

        return $this->returnSuccessMessage(__("mobile.Order deleted successfully."));
    }
}
