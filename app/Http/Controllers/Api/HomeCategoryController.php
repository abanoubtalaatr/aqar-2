<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\SimpleCategoryResource;

class HomeCategoryController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        // Start a query for Category
        $categories = Category::query();

        // Apply filters based on request parameters
        if ($request->has('for_rent') && $request->input('for_rent') == 1) {
            $categories->where('for_rent', 1)->orderBy('sort_rent', 'asc');
        } elseif ($request->has('for_sell') && $request->input('for_sell') == 1) {
            $categories->where('for_sell', 1)->orderBy('sort_sell', 'asc');
        } elseif ($request->has('per_day_or_month') && $request->input('per_day_or_month') == 1) {
            $categories->where('per_day_or_month', 1)->orderBy('sort_per_day_or_month', 'asc');
        } elseif ($request->has('order_for_sell') && $request->input('order_for_sell') == 1) {
            $categories->where('order_for_sell', 1)->orderBy('sort_order_for_sell', 'asc');
        } elseif ($request->has('order_for_rent') && $request->input('order_for_rent') == 1) {
            $categories->where('order_for_rent', 1)->orderBy('sort_order_for_rent', 'asc');
        } elseif ($request->input('orders') && $request->input('orders') == 1) {
            $locale = App::getLocale();

            $allCategory = Category::make([
                'id' => 'order',
                'name_ar' => $locale === 'ar' ? __('mobile.all') : null,
                'name_en' => $locale === 'en' ? __('mobile.All') : null,
                'type' => 'all',
            ]);

            $forRent = Category::where('order_for_rent', 1)
                ->orderBy('sort_order_for_rent')
                ->get()
                ->map(function ($category) {
                    $category->type = 'rent';
                    return $category;
                });

            $forSell = Category::where('order_for_sell', 1)
                ->orderBy('sort_order_for_sell')
                ->get()
                ->map(function ($category) {
                    $category->type = 'sell';
                    return $category;
                });

            $allCategories = collect([$allCategory])->merge($forSell)->merge($forRent);

            return response()->json([
                'status' => true,
                'data' => CategoryResource::collection($allCategories),
                'msg' => '',
            ]);

        }

        // Fetch categories based on applied filters
        $filteredCategories = $categories->get();

        // Add the "All" category at the beginning
        $allCategory = [
            'id' => $request->for_rent
            ? 'rent'
            : ($request->for_sell
                ? 'sell'
                : 'per_day_or_month'),
            'name' => __('mobile.All')
        ];

        // Merge "All" with the filtered categories
        $categoriesWithAll = collect([$allCategory])->merge($filteredCategories);

        // Return the data with a resource collection
        return $this->returnData('data', SimpleCategoryResource::collection($categoriesWithAll));
    }
}
