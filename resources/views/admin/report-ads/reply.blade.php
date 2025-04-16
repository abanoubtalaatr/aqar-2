@extends('admin.app')
@section('title', __('dashboard.Reply to report'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.Reply to report') #{{ $report->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.reports.index') }}" 
                           class="btn btn-tool btn-sm btn-secondary"
                           title="@lang('dashboard.Back to List')">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Display Contact Service Details -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>@lang('dashboard.Details')</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>@lang('dashboard.user')</th>
                                    <td>{{ $report->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('dashboard.ad id')</th>
                                    <td>{{ $report->ad->id }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('dashboard.reason')</th>
                                    <td>{{ $report->reason->name }}</td>
                                </tr>
                                @if($report->another_reason)
                                <tr>
                                    <th>@lang('dashboard.another reason')</th>
                                    <td>{{ $report->another_reason }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>@lang('dashboard.created at')</th>
                                    <td>{{ $report->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Reply Form -->
                    <form action="{{ route('admin.reports.store-reply', $report->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="reply_message">@lang('dashboard.Reply Message')</label>
                            <textarea class="form-control" name="reply_message" id="reply_message" rows="4" 
                                      placeholder="@lang('dashboard.Enter your reply here')" required></textarea>
                            @error('reply_message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-reply"></i> @lang('dashboard.Send Reply')
                            </button>
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">
                                @lang('dashboard.Cancel')
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection