@extends('admin.app')
@section('title', __('dashboard.users'))

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">

                        @can('admin.users.create')
                            <a href="{{ route('admin.users.create') }}" class="btn btn-tool btn-sm btn-primary"
                                title="@lang('dashboard.Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                    </div>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">
                            <input type="text" name="keyword" class="form-control col-md-4"
                                placeholder="@lang('dashboard.The Search')" value="{{ request()->keyword }}" /> &nbsp;

                            <select name="license_type" class="form-control col-md-3" onchange="this.form.submit()">
                                <option value="">@lang('dashboard.All License Types')</option>
                                <option value="Real Estate Authority"
                                    {{ request('license_type') == 'Real Estate Authority' ? 'selected' : '' }}>
                                    @lang('dashboard.Real Estate Authority')
                                </option>
                                <option value="Tourism" {{ request('license_type') == 'Tourism' ? 'selected' : '' }}>
                                    @lang('dashboard.Tourism')
                                </option>
                            </select> &nbsp;


                        </div>

                        <div class="row col-md-12 my-3">

                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            &nbsp;
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                            &nbsp;

                            <div class="col-md-6">
                                @include('admin.partials.per_page')
                            </div>
                        </div>
                        <div class="row">
                            <!-- Export Button -->
                            <div class="col-md-2">
                                <a href="{{ route('admin.users.export', request()->all()) }}" class="btn btn-success">
                                    @lang('dashboard.Export')
                                </a>
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
                                    <!-- <th><i class="fa fa-camera"></i></th> -->
                                    <th>@lang('dashboard.name')</th>
                                    <th>@lang('dashboard.mobile')</th>
                                    <th>@lang('dashboard.email') </th>
                                    <th>@lang('dashboard.is_active') </th>

                                    <th style="width: 180px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($items) < 1)
                                    <tr>
                                        <td colspan="7">@lang('dashboard.There are no items found!')</td>
                                    </tr>
                                @endif
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->is_active ? __('dashboard.yes') : __('dashboard.no') }}</td>

                                        <td>
                                            <button
                                                class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-100 transition"
                                                title="{{ $item->is_active == 1 ? __('Disable') : __('Activate') }}"
                                                data-remote="{{ route('admin.status_change', ['model' => User::class, 'item' => $item->id]) }}">
                                                <i
                                                    class="{{ $item->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                            </button>


                                            @can('user-update')
                                                <a href="{{ route('admin.users.edit', ['user' => $item->id]) }}"
                                                    class="btn btn-tool btn-sm btn-info" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan


                                            @can('user-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                    data-remote="{{ route('admin.users.destroy', ['user' => $item->id]) }}">
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
                    {{ $items->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>

            </div>

        </div>
    </div>

@endsection

@section('popup')

@endsection


@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection
