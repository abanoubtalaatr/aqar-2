@extends('admin.app')
@section('title', __('dashboard.contact services'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent d-flex justify-content-between align-items-center">
                    {{-- <h3 class="card-title">@lang('dashboard.View all')</h3> --}}
                    <form method="GET" action="{{ route('admin.contact-services.index') }}"
                        class="row g-2 align-items-center">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <!-- Keyword Search -->
                                <div class="col-md-3">
                                    <input type="text" name="keyword" class="form-control"
                                        placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" />
                                </div>

                                <!-- Main Service Type Filter -->
                                <div class="col-md-3">
                                    <select name="main_type" class="form-control" onchange="this.form.submit()">
                                        <option value="">@lang('dashboard.All Main Types')</option>
                                        <option value="engineering"
                                            {{ request('main_type') == 'engineering' ? 'selected' : '' }}>
                                            @lang('dashboard.engineering')
                                        </option>
                                        <option value="decoration"
                                            {{ request('main_type') == 'decoration' ? 'selected' : '' }}>
                                            @lang('dashboard.decoration')
                                        </option>
                                        <option value="construction"
                                            {{ request('main_type') == 'construction' ? 'selected' : '' }}>
                                            @lang('dashboard.construction')
                                        </option>
                                    </select>
                                </div>

                                <!-- Sub-Service Type Filter -->
                                <div class="col-md-3">
                                    <select name="sub_type" class="form-control" onchange="this.form.submit()">
                                        <option value="">@lang('dashboard.All Sub Types')</option>
                                        @foreach ($subServiceTypes as $subType)
                                            <option value="{{ $subType->id }}"
                                                {{ request('sub_type') == $subType->id ? 'selected' : '' }}>
                                                {{ $subType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Search Button -->
                                <div class="col-md-2 mb-2">
                                    <input type="submit" class="btn btn-primary w-100" value="@lang('dashboard.Search')" />
                                </div>

                                <!-- All Button -->
                                <div class="col-md-2">
                                    <a href="{{ route('admin.contact-services.index') }}" class="btn btn-primary w-100">
                                        @lang('dashboard.All')
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Per Page -->
                        <div class="col-md-2">
                            @include('admin.partials.per_page')
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0 text-center" id="tbl">
                            <thead>
                                <tr>
                                    <th>@lang('dashboard.user')</th>
                                    <th>@lang('dashboard.email')</th>
                                    <th>@lang('dashboard.mobile')</th>
                                    <th>@lang('dashboard.service type')</th>
                                    <th>@lang('dashboard.description')</th>
                                    <th>@lang('dashboard.share with')</th>
                                    <th>@lang('dashboard.created at')</th>
                                    <th style="width: 180px;">@lang('dashboard.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact_services as $contact_service)
                                    <tr>
                                        <td>{{ $contact_service->user->name }}</td>
                                        <td>{{ $contact_service->user->email }}</td>
                                        <td>{{ $contact_service->user->phone }}</td>
                                        <td>{{ __('dashboard.' . strtolower($contact_service->serviceType->type)) }}</td>
                                        <td>{{ $contact_service->message }}</td>
                                        <td>{{ $contact_service->share_with ? __('dashboard.yes') : __('dashboard.no') }}
                                        </td>
                                        <td>{{ $contact_service->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            @can('contact-service-update')
                                                <button
                                                    class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 "
                                                    title="{{ $contact_service->is_active == 1 ? __('Disable') : __('Activate') }}"
                                                    data-remote="{{ route('admin.status_change', ['model' => ContactService::class, 'item' => $contact_service->id]) }}">
                                                    <i
                                                        class="{{ $contact_service->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                                </button>
                                            @endcan

                                            @can('contact-service-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('dashboard.Delete')"
                                                    data-remote="{{ route('admin.contact-services.destroy', ['contact_service' => $contact_service->id]) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="card-footer clearfix">
                    {{ $contact_services->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection
