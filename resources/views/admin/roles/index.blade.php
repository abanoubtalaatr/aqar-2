@extends('admin.app')
@section('title', __('dashboard.Roles'))

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">

                        @can('role-create')
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-tool btn-sm btn-primary"
                                title="@lang('Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                    </div>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">
                            <input type="text" name="keyword" class="form-control col-md-4"
                                placeholder="@lang('dashboard.The Search')" value="{{ request()->keyword }}" /> &nbsp;

                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            &nbsp;
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                            &nbsp;
                            {{-- <a href="{{ route('admin.roles.export') }}" class="btn btn-info"><i
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
                                    <th>@lang('dashboard.id')</th>
                                    <th>@lang('dashboard.name_en')</th>
                                    <th>@lang('dashboard.name_ar')</th>
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
                                        <td>{{ $item->name_ar }}</td>

                                        <td>
                                            
                                            {{-- @can('user-update') --}}
                                                <a href="{{ route('admin.roles.edit', ['role'=>$item->id]) }}"
                                                    class="btn btn-tool btn-sm btn-info" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            {{-- @endcan --}}

                                            {{-- @can ('user-delete') --}}
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                    data-remote="{{ route('admin.roles.destroy', ['role'=>$item->id]) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            {{-- @endcan --}}

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
