<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        $categories = Category::query();

        if ($request->has('for_rent') && $request->input('for_rent') == 1) {
            $categories = $categories->where('for_rent', 1)->orderBy('sort_rent', 'asc');
        }

        if ($request->has('for_sell') && $request->input('for_sell') == 1) {
            $categories = $categories->where('for_sell', 1)->orderBy('sort_sell', 'asc');
        }

        if ($request->has('per_day_or_month') && $request->input('per_day_or_month') == 1) {
            $categories = $categories->where('per_day_or_month', 1)->orderBy('sort_per_day_or_month', 'asc');
        }

        if ($request->has('order_for_sell') && $request->input('order_for_sell') == 1) {
            $categories = $categories->where('order_for_sell', 1)->orderBy("sort_order_for_sell", 'asc');
        }

        if ($request->has('order_for_rent') && $request->input('order_for_rent') == 1) {
            $categories = $categories->where('order_for_rent', 1)->orderBy("sort_order_for_rent", 'asc');
        }

        if ($request->input('orders')) {
            // Fetch categories that are for rent and assign type 'rent'
            $forRent = Category::where('order_for_rent', 1)->orderBy('sort_order_for_rent')->get()->map(function ($category) {
                $category->type = 'rent'; // Add the 'type' property
                return $category; // Return the modified category
            });

            // Fetch categories that are for sell and assign type 'sell'
            $forSell = Category::where('order_for_sell', 1)->orderBy('sort_order_for_sell')->get()->map(function ($category) {
                $category->type = 'sell'; // Add the 'type' property
                return $category; // Return the modified category
            });

            return response()->json([
                'status' => true,
                'data' => CategoryResource::collection($forSell),  // Categories for sell
                'for_rent' => CategoryResource::collection($forRent), // Categories for rent
                'msg' => '',
            ]);
        }

        $categories = $categories->get();

        $categories = CategoryResource::collection($categories);

        return $this->returnData('data', $categories);
    }
}
