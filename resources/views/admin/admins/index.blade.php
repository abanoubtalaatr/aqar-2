@extends('admin.app')
@section('title', __('dashboard.Admins'))

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">

                        @if (has_permission('admin.admins.create'))
                            <a href="{{ route('admin.admins.create') }}" class="btn btn-tool btn-sm btn-primary"
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
                            <a href="{{ route('admin.admins.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                            &nbsp;
                            {{-- <a href="{{ route('admin.admins.export') }}" class="btn btn-info"><i
                                    class="fa fa-file-export"></i>
                                @lang('Export')</a> --}}

                            <div class="col-md-2">
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
                                    <th>@lang('dashboard.ID')</th>
                                    <th>@lang('dashboard.name')</th>
                                    <th>@lang('dashboard.mobile')</th>
                                    <th>@lang('dashboard.email') </th>
                                    {{-- <th> @lang('dasbhoard.status') </th> --}}
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
                                        <td>
                                            <!-- <img  class="indexPhoto"  src="{{ asset($item->photo) }}" alt="" srcset=""> -->
                                            {{ $item->name }}
                                        </td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            {{-- <span class="badge badge-{{ $item->is_active == 1 ? 'success' : 'pending' }} ">
                                                {{ $item->is_active == 1 ? __('Active') : __('Deactive') }}
                                            </span>
                                        </td> --}}
                                        <td>
                                            @can('admin-update')
                                                <button
                                                    class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-100 transition"
                                                    title="{{ $item->is_active == 1 ? __('Disable') : __('Activate') }}"
                                                    data-remote="{{ route('admin.status_change', ['model' => User::class, 'item' => $item->id]) }}">
                                                    <i
                                                        class="{{ $item->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                                </button>
                                            @endcan
                                            @can('admin-update')
                                                <a href="{{ route('admin.admins.edit', ['admin' => $item->id]) }}"
                                                    class="btn btn-tool btn-sm btn-info" title="@lang('dashboard.Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('admin-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('dashboard.Delete')"
                                                    data-remote="{{ route('admin.admins.destroy', ['admin' => $item->id]) }}">
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
