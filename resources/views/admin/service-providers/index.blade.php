
@extends('admin.app')
@section('title', __('dashboard.Service Providers'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">
                        @if (has_permission('admin.service-providers.create'))
                            <a href="{{ route('admin.service-providers.create') }}" class="btn btn-tool btn-sm btn-primary" title="@lang('dashboard.Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endif
                    </div>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">
                            <input type="text" name="keyword" class="form-control col-md-4" placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" /> &nbsp;
                            <div class="col-md-3">
                                <select name="service_type_id" class="form-control" onchange="this.form.submit()">
                                    <option value="">@lang('dashboard.Service Type')</option>
                                    @foreach ($serviceTypes as $type)
                                        <option value="{{ $type->id }}" {{ request('service_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" /> &nbsp;
                            <a href="{{ route('admin.service-providers.index') }}" class="btn btn-primary">@lang('dashboard.All')</a> &nbsp;

                            <div class="col-md-2 mt-3">
                                @include('admin.partials.per_page')
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0 text-center" id="tbl">
                            <thead>
                                <tr>
                                    <th>@lang('dashboard.id')</th>
                                    <th>@lang('dashboard.Service Type')</th>
                                    <th>@lang('dashboard.Emails')</th>
                                    <th style="width: 180px;">@lang('dashboard.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($serviceProviders as $serviceProvider)
                                    <tr>
                                        <td>{{ $serviceProvider->id }}</td>
                                        <td>{{ $serviceProvider->serviceType->name }}</td>
                                        <td>{{ $serviceProvider->emails }}</td>
                                        <td>
                                            <button class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md transition"
                                                title="{{ $serviceProvider->is_active == 1 ? __('Disable') : __('Activate') }}"
                                                data-remote="{{ route('admin.status_change', ['model' => ServiceProvider::class, 'item' => $serviceProvider->id]) }}">
                                                <i class="{{ $serviceProvider->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                            </button>

                                            @can('service-provider-update')
                                                <a href="{{ route('admin.service-providers.edit', $serviceProvider->id) }}" class="btn btn-tool btn-sm btn-info" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('service-provider-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                    data-remote="{{ route('admin.service-providers.destroy', ['service_provider' => $serviceProvider->id]) }}">
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
                    {{ $serviceProviders->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection