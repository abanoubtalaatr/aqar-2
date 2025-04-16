<?php

namespace App\Exports;

use App\Models\Ad;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Report;
use App\Models\ServiceProvider;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StatisticsExport implements FromView
{
    public function view(): View
    {
        $currentMonth = Carbon::now()->startOfMonth();

        $reportAds = Report::whereNotNull('ad_id')->whereNull('order_id')->count();
        $reportOrders = Report::whereNotNull('order_id')->whereNull('ad_id')->count();
        $serviceProviders = ServiceProvider::count();

        return view('admin.statistics.export', [
            'usersWithoutPermissions' => User::doesntHave('roles')->count(),
            'activeAdsCount' => Ad::where('is_active', 1)->where('created_at', '>=', $currentMonth)->count(),
            'ordersCount' => Order::where('is_active', 1)->where('created_at', '>=', $currentMonth)->count(),
            'totalVisits' => Ad::where('is_active', 1)->sum('views_count'),
            'totalTradingValue' => Ad::where('is_active', 1)->where('created_at', '>=', $currentMonth)->sum('price'),
            'serviceProviders' => $serviceProviders,
            'reportAds' => $reportAds,
            'reportOrders' => $reportOrders,
        ]);
    }
}
