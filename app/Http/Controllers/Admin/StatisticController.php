<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Report;
use App\Models\ServiceProvider;
use App\Exports\StatisticsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class StatisticController extends Controller
{
    public function __invoke()
    {
        $stats = $this->getStatistics();

        return view('admin.statistics.index', $stats);
    }

    public function export()
    {
        return Excel::download(new StatisticsExport(), 'statistics.xlsx');
    }

    private function getStatistics()
    {
        $currentMonth = Carbon::now()->startOfMonth();

        $reportAds = Report::whereNotNull('ad_id')->whereNull('order_id')->count();
        $reportOrders = Report::whereNotNull('order_id')->whereNull('ad_id')->count();
        $serviceProviders = ServiceProvider::count();


        return [
            'usersWithoutPermissions' => User::doesntHave('roles')->count(),
            'activeAdsCount' => Ad::where('is_active', 1)->where('created_at', '>=', $currentMonth)->count(),
            'ordersCount' => Order::where('is_active', 1)->where('created_at', '>=', $currentMonth)->count(),
            'totalVisits' => Ad::where('is_active', 1)->sum('views_count'),
            'totalTradingValue' => Ad::where('is_active', 1)->where('created_at', '>=', $currentMonth)->sum('price'),
            'serviceProviders' => $serviceProviders,
            'reportAds' => $reportAds,
            'reportOrders' => $reportOrders,

        ];
    }
}
