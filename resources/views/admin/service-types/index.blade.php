@extends('admin.app')
@section('title', __('dashboard.service types'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">
                        @can('service-type-create')
                            <a href="{{ route('admin.service-types.create') }}" class="btn btn-tool btn-sm btn-primary"
                                title="@lang('dashboard.Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                    </div>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">

                            <input type="text" name="keyword" class="form-control col-md-4"
                                placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" />

                            <input type="submit" class="btn btn-primary col-md-1 mx-1" value="@lang('dashboard.Search')" />
                            <a href="{{ route('admin.service-types.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                            <select name="type" class="form-control col-md-3 mx-1" onchange="this.form.submit()">
                                <option value="">@lang('dashboard.All')</option>
                                @foreach ($serviceTypes as $type)
                                    <option value="{{ $type->type }}"
                                        {{ request('type') == $type->type ? 'selected' : '' }}>
                                        {{ $type->type }}
                                    </option>
                                @endforeach

                            </select> &nbsp;
                            
                        </div>
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
                                    <th>@lang('dashboard.id')</th>
                                    <th>@lang('dashboard.service type in arabic')</th>
                                    <th>@lang('dashboard.service type in english')</th>
                                    <th>@lang('dashboard.type')</th>
                                    <th style="width: 180px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service_types as $service_type)
                                    <tr>
                                        <td>{{ $service_type->id }}</td>
                                        <td>{{ $service_type->name_ar }}</td>
                                        <td>{{ $service_type->name_en }}</td>
                                        <td>{{ __("dashboard." . strtolower($service_type->type)) }}</td>                                        <td>


                                            @can('service-type-update')
                                                <button
                                                    class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-100 transition"
                                                    title="{{ $service_type->is_active == 1 ? __('Disable') : __('Activate') }}"
                                                    data-remote="{{ route('admin.status_change', ['model' => ServiceType::class, 'item' => $service_type->id]) }}">
                                                    <i
                                                        class="{{ $service_type->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                                </button>
                                                <a href="{{ route('admin.service-types.edit', $service_type->id) }}"
                                                    class="btn btn-tool btn-sm btn-info" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('service-type-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                    data-remote="{{ route('admin.service-types.destroy', ['service_type' => $service_type->id]) }}">
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
                    {{ $service_types->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection
