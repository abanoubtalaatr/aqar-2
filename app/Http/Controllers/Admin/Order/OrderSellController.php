<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;
use App\Models\Category;
use App\Filters\OrderFilters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderSellController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['category', 'user'])->where('for_rent', 0);

        $filters = new OrderFilters($request);
        $query = $filters->apply($query);

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $items = $query->latest('published_at')->paginate($perPage);

        $categories = Category::where('order_for_sell', 1)->get();

        $routeName = 'admin.orders-sell.index';
        $title =  __('dashboard.orders for sell');

        // Table headers
        $tableHeaders = $this->tableHeaders();

        // dd($items);
        // Table items formatted as an associative array
        $tableItems = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'category' => $item->category->name ?? '',
                'user_info' => $item->user->name . "<br>" . $item->user->phone,
                'price_from' => number_format($item->price_from),
                'price_to' => number_format($item->price_to),
                'area_from' => $item->area_from,
                'area_to' => $item->area_to,
                'published_at' => $item->published_at,
                'actions' => view('admin.orders.partials.actions', ['item' => $item])->render(),
            ];
        });

        return view('admin.orders.index', compact('items', 'categories', 'routeName', 'title', 'tableHeaders', 'tableItems'));
    }


    public function tableHeaders()
    {
        return  [
            'id' => __('dashboard.order id'),
            'category' => __('dashboard.category'),
            'user_info' => __('dashboard.user info'),
            'price_from' => __('dashboard.price from'),
            'price_to' => __('dashboard.price to'),
            'area_from' => __('dashboard.area from'),
            'area_to' => __('dashboard.area to'),
            'published_at' => __('dashboard.published at'),
            'actions' => __('dashboard.actions')
        ];
    }

}
