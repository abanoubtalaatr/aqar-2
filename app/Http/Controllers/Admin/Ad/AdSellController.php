<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Models\Ad;
use App\Models\Category;
use App\Filters\AdFilters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdSellController extends Controller
{
    public function index(Request $request)
    {
        $query = Ad::with(['category', 'user'])->where('for_rent', 0)->orWhereNull('for_rent');

        $filters = new AdFilters($request);
        $query = $filters->apply($query);
        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $items = $query->latest('published_at')->paginate($perPage);

        $categories = Category::where('for_sell', 1)->get();

        $routeName = 'admin.ads-sell.index';

        $title =  __('dashboard.ads for sell');

        $basicFilterWhenExport = ['for_rent' => 0];

        // Table headers
        $tableHeaders = $this->tableHeaders();

        // Table items formatted as an associative array
        $tableItems = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'license_number' => $item->license_number,
                'category' => $item->category->name ?? '',
                'user_info' => $item->user->name . "<br>" . $item->user->phone,
                'price' => number_format($item->price),
                'area' => $item->area,
                'status' => view('admin.ads.partials.status-badge', ['status' => $item->status])->render(),
                'published_at' => $item->published_at,
                'actions' => view('admin.ads.partials.actions', ['item' => $item])->render(),
            ];
        });

        return view('admin.ads.index', compact('items', 'categories', 'routeName', 'title', 'tableHeaders', 'tableItems', 'basicFilterWhenExport'));
    }


    public function tableHeaders()
    {
        return  [
            'id' => __('dashboard.ad id'),
            'license_number' => __('dashboard.license number'),
            'category' => __('dashboard.category'),
            'user_info' => __('dashboard.user info'),
            'price' => __('dashboard.price'),
            'area' => __('dashboard.area'),
            'status' => __('dashboard.status'),
            'published_at' => __('dashboard.published at'),
            'actions' => __('dashboard.actions')
        ];
    }

}
