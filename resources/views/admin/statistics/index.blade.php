@extends('admin.app')
@section('title', __('dashboard.statistics'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.statistics')</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.statistics.export') }}" class="btn btn-success">
                            @lang('dashboard.Export')
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Users -->
                        <div class="col-md-4">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">@lang('dashboard.users')</span>
                                    <span class="info-box-number">{{ $usersWithoutPermissions }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Ads for This Month -->
                        <div class="col-md-4">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-bullhorn"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">@lang('dashboard.Ads for this month')</span>
                                    <span class="info-box-number">{{ $activeAdsCount }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Orders This Month -->
                        <div class="col-md-4">
                            <div class="info-box bg-secondary">
                                <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">@lang('dashboard.Orders This Month')</span>
                                    <span class="info-box-number">{{ $ordersCount }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Total Visits for This Month -->
                        <div class="col-md-4">
                            <div class="info-box bg-primary">
                                <span class="info-box-icon"><i class="fas fa-eye"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">@lang('dashboard.Total visits for this month')</span>
                                    <span class="info-box-number">{{ $totalVisits }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Total Trading Value for This Month -->
                        <div class="col-md-4">
                            <div class="info-box bg-danger">
                                <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">@lang('dashboard.Total Trading Value for this month')</span>
                                    <span class="info-box-number">{{ number_format($totalTradingValue, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Service Providers -->
                        <div class="col-md-4">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-tools"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">@lang('dashboard.service-providers')</span>
                                    <span class="info-box-number">{{ $serviceProviders }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Reports Ads -->
                        <div class="col-md-4">
                            <div class="info-box bg-maroon">
                                <span class="info-box-icon"><i class="fas fa-flag"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">@lang('dashboard.reports ads')</span>
                                    <span class="info-box-number">{{ $reportAds }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Reports Orders -->
                        <div class="col-md-4">
                            <div class="info-box bg-orange">
                                <span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">@lang('dashboard.reports orders')</span>
                                    <span class="info-box-number">{{ $reportOrders }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection