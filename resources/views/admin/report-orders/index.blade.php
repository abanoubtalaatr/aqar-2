@extends('admin.app')
@section('title', __('dashboard.reports orders'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">
                            <input type="text" name="keyword" class="form-control col-md-4" placeholder="@lang('dashboard.Search')"
                                value="{{ request()->keyword }}" /> &nbsp;

                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            <a href="{{ route('admin.report-ads.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>

                            <div class="col-md-3">

                                <select name="reason" class="form-control w-100" onchange="this.form.submit()">
                                    <option value="">@lang('dashboard.all reasons')</option>
                                    @foreach ($reasons as $reason)
                                        <option value="{{$reason->id}}" {{ request('reason') == $reason->id ? 'selected' : '' }}>
                                            {{$reason->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
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
                                    <th>@lang('dashboard.user')</th>
                                    <th>@lang('dashboard.order id')</th>
                                    <th>@lang('dashboard.reason')</th>
                                    <th>@lang('dashboard.another reason')</th>
                                    <th>@lang('dashboard.created at')</th>
                                    <th style="width: 180px;">@lang('dashboard.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $report->user->name }}</td>
                                        <td>{{ $report->order?->id }}</td>
                                        <td>{{ $report->reason->title }}</td>
                                        <td>{{ $report->another_reason ?? '--' }}</td>
                                        <td>{{ $report->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>


                                            @can('report-ad-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('dashboard.Delete')"
                                                    data-remote="{{ route('admin.report-ads.destroy', ['report_ad' => $report->id]) }}">
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
            </div>

            <div class="card-footer clearfix">
                {{ $reports->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.ajax.delete')
@endsection
