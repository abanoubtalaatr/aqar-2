<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Models\Order;
use App\Filters\AdFilters;
use App\Filters\OrderFilters;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SimpleAdResource;
use App\Http\Resources\Api\OrderResource;

class SearchController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        // Validate that 'id' is provided
        $request->validate([
            'id' => 'required|numeric',
        ]);

        $id = $request->input('id');
        $paginate = $request->has('paginate') && $request->input('paginate') == 1;

        // Query for Orders
        $orderQuery = Order::query()
            ->where('is_active', 1)
            ->where('id', $id); // Search by id

        $orderFilters = new OrderFilters($request);
        $orderQuery = $orderFilters->apply($orderQuery);
        $orders = $paginate ? $orderQuery->paginate() : $orderQuery->get();

        // Query for Ads
        $adQuery = Ad::query()
            ->where('is_active', 1)
            ->where('id', $id); // Search by id

        $adFilters = new AdFilters($request);
        $adQuery = $adFilters->apply($adQuery);
        $ads = $paginate ? $adQuery->paginate() : $adQuery->get();

        // Prepare response data
        $responseData = [];

        // Handle Orders data
        if ($paginate && $orders->isNotEmpty()) {
            $responseData['orders'] = OrderResource::collection($orders)->response()->getData();
        } elseif ($orders->isNotEmpty()) {
            $responseData['orders'] = [
                'data' => OrderResource::collection($orders),
                'total' => $orders->count(),
            ];
        } else {
            $responseData['orders'] = [
                'data' => [],
                'total' => 0,
            ];
        }

        // Handle Ads data
        if ($paginate && $ads->isNotEmpty()) {
            $responseData['ads'] = SimpleAdResource::collection($ads)->response()->getData();
        } elseif ($ads->isNotEmpty()) {
            $responseData['ads'] = [
                'data' => SimpleAdResource::collection($ads),
                'total' => $ads->count(),
            ];
        } else {
            $responseData['ads'] = [
                'data' => [],
                'total' => 0,
            ];
        }

        // Return combined response
        return $this->returnData('data', $responseData);
    }
}
