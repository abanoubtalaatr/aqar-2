<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;
use App\Models\Category;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.orders.create', compact('categories'));
    }
    public function destroy(Order $order)
    {
        $order->delete();

        return 1;
    }
}
