<table>
    <thead>
        <tr>
            <th>@lang('dashboard.Metric')</th>
            <th>@lang('dashboard.Value')</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>@lang('dashboard.users')</td>
            <td>{{ $usersWithoutPermissions }}</td>
        </tr>
        <tr>
            <td>@lang('dashboard.Ads for this month')</td>
            <td>{{ $activeAdsCount }}</td>
        </tr>
        <tr>
            <td>@lang('dashboard.Orders This Month')</td>
            <td>{{ $ordersCount }}</td>
        </tr>
        <tr>
            <td>@lang('dashboard.Total visits for this month')</td>
            <td>{{ $totalVisits }}</td>
        </tr>
        <tr>
            <td>@lang('dashboard.Total Trading Value for this month')</td>
            <td>{{ number_format($totalTradingValue, 2) }}</td>
        </tr>
        <tr>
            <td>@lang('dashboard.service-providers')</td>
            <td>{{ $serviceProviders }}</td>
        </tr>
        <tr>
            <td>@lang('dashboard.reports ads')</td>
            <td>{{ $reportAds }}</td>
        </tr>
        <tr>
            <td>@lang('dashboard.reports orders')</td>
            <td>{{ $reportOrders }}</td>
        </tr>
    </tbody>
</table>
