<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Order;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Filters\OrderFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\Api\OrderResource;
use App\Services\Order\StoreOrderService;
use App\Services\Order\UpdateOrderService;

class OrderController extends Controller
{
    use GeneralTrait;

    protected $updateOrderService;
    protected $storeOrderService;

    public function __construct(
        UpdateOrderService $updateOrderService,
        StoreOrderService $storeOrderService
    ) {
        $this->updateOrderService = $updateOrderService;
        $this->storeOrderService = $storeOrderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query()->where('is_active', 1);

        $filters = new OrderFilters($request);

        $query = $filters->apply($query);

        $orders = $request->has('paginate') && $request->input('paginate') == 1 ? $query->paginate() : $query->get();
        $total_orders = $orders instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator ? $orders->total() : $orders->count();

        if ($request->has('paginate') && $request->input('paginate') == 1) {
            $orders_data = OrderResource::collection($orders)->response()->getData();
            $data['data'] = $orders_data;
            $data['total'] = $total_orders;

        } else {
            $orders_data = OrderResource::collection($orders);
            $data['data'] = $orders_data;
            $data['total'] = $total_orders;
        }


        return $this->returnData('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $order = $this->storeOrderService->createOrder($request);

        return $this->returnData('data', $order, __('mobile.added successfully.'));
    }

    /**
     * Update the specified order in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $updatedOrder = $this->updateOrderService->updateOrder($order, $request);

        return $this->returnData('data', $updatedOrder, __('mobile.Order updated successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order->increment('views_count');

        return $this->returnData('data', OrderResource::make($order));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return $this->returnSuccessMessage(__("mobile.Order deleted successfully."));
    }
}
