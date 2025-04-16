@extends('admin.app')
@section('title', __('dashboard.cities'))

@section('content')
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title">@lang('dashboard.View all')</h3>
            <div class="card-tools">

                @if (has_permission('admin.cities.create'))
                    <a href="{{ route('admin.cities.create') }}" class="btn btn-tool btn-sm btn-primary"
                        title="@lang('dashboard.Add')">
                        <i class="fas fa-plus"></i>
                    </a>
                @endif
            </div>

            <form class="row col-md-12">
                <div class="col-md-10 row">
                    <input type="text" name="keyword" class="form-control col-md-4"
                        placeholder="@lang('dashboard.The Search')" value="{{ request()->keyword }}" /> &nbsp;

                    <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                    &nbsp;
                    <a href="{{ route('admin.cities.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                    &nbsp;
                    
                    <div class="col-md-2">
                        @include('admin.partials.per_page')
                    </div>
                </div>

            </form>


        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center w-100" id="tbl">
                <thead>
                    <tr>
                        <th>@lang('dashboard.id')</th>
                        <th>@lang('dashboard.name_ar')</th>
                        <th>@lang('dashboard.name_en')</th>
                        <th>@lang('dashboard.latitude_min')</th>
                        <th>@lang('dashboard.latitude_max')</th>
                        <th>@lang('dashboard.longitude_min')</th>
                        <th>@lang('dashboard.longitude_max')</th>
                        <th>@lang('dashboard.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr>
                            <td>{{ $city->id }}</td>
                            <td>{{ $city->name_ar }}</td>
                            <td>{{ $city->name_en }}</td>
                            <td>{{ $city->latitude_min }}</td>
                            <td>{{ $city->latitude_max }}</td>
                            <td>{{ $city->longitude_min }}</td>
                            <td>{{ $city->longitude_max }}</td>
                            <td>
                                <button
                                class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-100 transition"
                                title="{{ $city->is_active == 1 ? __('Disable') : __('Activate') }}"
                                data-remote="{{ route('admin.status_change', ['model' => City::class, 'item' =>  $city->id]) }}">
                                <i class="{{ $city->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                            </button>
                            
                                <a href="{{ route('admin.cities.edit', $city) }}" class="btn btn-info btn-sm"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                    data-remote="{{ route('admin.cities.destroy', ['city' => $city->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer clearfix">
                {{ $cities->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection
