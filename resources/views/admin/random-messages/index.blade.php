@extends('admin.app')
@section('title', __('dashboard.Random Messages'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    {{-- <h3 class="card-title">@yield('title')</h3> --}}
                    <div class="card-tools">
                        <a href="{{ route('admin.random-messages.create') }}"
                            class="btn btn-sm btn-info">@lang('dashboard.Add')</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form method="GET">
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="@lang('dashboard.Search')" class="form-control" style="width: 200px; margin: 10px;">
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tbl">
                            <thead>
                                <tr>
                                    <th>@lang('dashboard.ID')</th>
                                    <th>@lang('dashboard.Name (Arabic)')</th>
                                    <th>@lang('dashboard.Name (English)')</th>
                                    <th>@lang('dashboard.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name_ar }}</td>
                                        <td>{{ $item->name_en }}</td>
                                        <td>
                                            <button
                                            class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-100 transition"
                                            title="{{ $item->is_active == 1 ? __('Disable') : __('Activate') }}"
                                            data-remote="{{ route('admin.status_change', ['model' => RandomMessage::class, 'item' => $item->id]) }}">
                                            <i
                                                class="{{ $item->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                        </button>

                                            @can('random-message-update')
                                            <a href="{{ route('admin.random-messages.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('random-message-delete')
                                            <button class="btn btn-tool btn-sm btn-danger" title="@lang('dashboard.Delete')"
                                                data-remote="{{ route('admin.random-messages.destroy', ['random_message' => $item->id]) }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endcan
    
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                <div class="card-footer clearfix">
                    {{ $items->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection
