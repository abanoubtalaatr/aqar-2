<div class="row">
    <!-- Users Card -->
    @can('user-read')
        <div class="col-lg-4 col-4">
            <div class="small-box bg-warning bg-gradient">
                <div class="inner">
                    <h3>{{ $users }}</h3>
                    <p>@lang('dashboard.users')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i> <!-- Better represents a group of users -->
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('admin-read')
        <!-- Admins Card -->
        <div class="col-lg-4 col-4">
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{ $admins }}</h3>
                    <p>@lang('dashboard.admins')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-cog"></i> <!-- Represents admin control -->
                </div>
                <a href="{{ route('admin.admins.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('ad-read')
        <!-- Rent Ads (Per Day/Month) Card -->
        <div class="col-lg-4 col-4">
            <div class="small-box bg-olive bg-gradient">
                <div class="inner">
                    <h3>{{ $rentAdsPerDayOrMonthCount }}</h3>
                    <p>@lang('dashboard.ads for day')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-day"></i> <!-- More specific to daily/monthly -->
                </div>
                <a href="{{ route('admin.ads-month-or-day.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('ad-read')
        <!-- Rent Ads Card -->
        <div class="col-lg-4 col-4">
            <div class="small-box bg-primary bg-gradient">
                <div class="inner">
                    <h3>{{ $rentAdsCount }}</h3>
                    <p>@lang('dashboard.ads for rent')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-home"></i> <!-- Represents renting property -->
                </div>
                <a href="{{ route('admin.ads-rent.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('ad-read')
        <!-- Sell Ads Card -->
        <div class="col-lg-4 col-4">
            <div class="small-box bg-danger bg-gradient">
                <div class="inner">
                    <h3>{{ $sellAdsCount }}</h3>
                    <p>@lang('dashboard.ads for sell')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i> <!-- Represents selling -->
                </div>
                <a href="{{ route('admin.ads-sell.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('order-read')
        <!-- Sell Orders Card -->
        <div class="col-lg-4 col-4">
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{ $sellOrdersCount }}</h3>
                    <p>@lang('dashboard.orders for sell')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cart-arrow-down"></i> <!-- Represents sell orders -->
                </div>
                <a href="{{ route('admin.orders-sell.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- Rent Orders Card -->
        <div class="col-lg-4 col-4">
            <div class="small-box bg-info bg-gradient">
                <div class="inner">
                    <h3>{{ $rentOrdersCount }}</h3>
                    <p>@lang('dashboard.orders for rent')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cart-plus"></i> <!-- Represents rent orders -->
                </div>
                <a href="{{ route('admin.orders-rent.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('category-read')
        <div class="col-lg-4 col-4">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{ $categories }}</h3>
                    <p>@lang('dashboard.categories')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i> <!-- Represents categories -->
                </div>
                <a href="{{ route('admin.categories.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('city-read')
        <div class="col-lg-4 col-4">
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{ $cities }}</h3>
                    <p>@lang('dashboard.cities')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-map-marker-alt"></i> <!-- Represents locations/cities -->
                </div>
                <a href="{{ route('admin.cities.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('report-ad-read')
        <div class="col-lg-4 col-4">
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{ $reportAds }}</h3>
                    <p>@lang('dashboard.reports ads')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-flag"></i> <!-- Represents reporting -->
                </div>
                <a href="{{ route('admin.report-ads.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('report-order-read')
        <div class="col-lg-4 col-4">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>{{ $reportOrders }}</h3>
                    <p>@lang('dashboard.reports orders')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i> <!-- Represents order issues -->
                </div>
                <a href="{{ route('admin.report-orders.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan

    @can('service-provider-read')
        <div class="col-lg-4 col-4">
            <div class="small-box bg-cyan">
                <div class="inner">
                    <h3>{{ $serviceProviders }}</h3>
                    <p>@lang('dashboard.service-providers')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tools"></i> <!-- Represents service providers -->
                </div>
                <a href="{{ route('admin.service-providers.index') }}" class="small-box-footer">
                    @lang('dashboard.more') <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endcan
</div>