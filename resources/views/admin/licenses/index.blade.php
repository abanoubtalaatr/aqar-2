@extends('admin.app')
@section('title', __('dashboard.licenses'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">
                        @if (has_permission('admin.licenses.create'))
                            <a href="{{ route('admin.licenses.create') }}" class="btn btn-tool btn-sm btn-primary"
                                title="@lang('dashboard.Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endif
                    </div>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">

                            <input type="text" name="keyword" class="form-control col-md-4"
                                placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" /> &nbsp;
                            <div class="col-md-3">
                                <select name="type" class="form-control" onchange="this.form.submit()">
                                    <option value="">@lang('dashboard.type')</option>
                                    <option value="Tourism" {{ request('type') == 'Tourism' ? 'selected' : '' }}>
                                        @lang('dashboard.Tourism')</option>
                                    <option value="Real Estate Authority"
                                        {{ request('type') == 'Real Estate Authority' ? 'selected' : '' }}>
                                        @lang('dashboard.Real Estate Authority')</option>

                                </select>
                            </div>

                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            &nbsp;

                            <a href="{{ route('admin.licenses.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                            &nbsp;

                            <select name="license_status" class="form-control col-md-3 mt-3" onchange="this.form.submit()">
                                <option value="">@lang('dashboard.All Status')</option>
                                <option value="active" {{ request('license_status') == 'active' ? 'selected' : '' }}>
                                    @lang('dashboard.Active')
                                </option>
                                <option value="pending" {{ request('license_status') == 'pending' ? 'selected' : '' }}>
                                    @lang('dashboard.Pending')
                                </option>
                                <option value="rejected" {{ request('license_status') == 'rejected' ? 'selected' : '' }}>
                                    @lang('dashboard.Rejected')
                                </option>
                            </select> &nbsp;

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
                                    <th>@lang('dashboard.user')</th>
                                    <th>@lang('dashboard.type')</th>
                                    <th>@lang('dashboard.status')</th>
                                    <th>@lang('dashboard.file')</th>
                                    <th style="width: 180px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($licenses) < 1)
                                    <tr>
                                        <td colspan="7">@lang('dashboard.There are no items found!')</td>
                                    </tr>
                                @endif
                                @foreach ($licenses as $license)
                                    <tr>
                                        <td>{{ $license->id }}</td>
                                        <td>{{ $license->user->name }}</td>
                                        <td>@lang('dashboard.' . $license->type)</td>
                                        <td>@lang('dashboard.' . $license->status)</td>
                                        <td>
                                            @if ($license->file)
                                                <a href="{{ url($license->file) }}" target="_blank">@lang('dashboard.view licenses')</a>
                                            @else
                                            @endif
                                        </td>
                                        <td>
                                            @if ($license->status == 'pending')
                                                <form
                                                    action="{{ route('admin.licenses.changeStatus', ['license' => $license->id, 'status' => 'active']) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-tool btn-sm btn-success"
                                                        title="@lang('dashboard.Accept')">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form
                                                    action="{{ route('admin.licenses.changeStatus', ['license' => $license->id, 'status' => 'pending']) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-tool btn-sm btn-warning"
                                                        title="@lang('dashboard.Pending')">
                                                        <i class="fas fa-pause-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form
                                                action="{{ route('admin.licenses.changeStatus', ['license' => $license->id, 'status' => 'rejected']) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-tool btn-sm btn-danger"
                                                    title="@lang('Reject')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>


                                            @can('license-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                    data-remote="{{ route('admin.licenses.destroy', ['license' => $license->id]) }}">
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
                    {{ $licenses->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('popup')
@endsection

@section('scripts')
    @include('admin.ajax.delete')
@endsection
