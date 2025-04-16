@extends('admin.app')
@section('title', __('dashboard.Dashboard'))
@section('content')
    {{-- --}}
    <div class="row">
        {{-- <div class="col-3 mb-3 form_wrapper">
            <form class="">
                <label>@lang('Period Filter')</label>
                <select class="form-control" name="period" onchange="this.form.submit()">
                    <option value="all">@lang('All')</option>
                    <option value="1" {{ !request()->period || request()->period == 1 ? 'selected' : '' }}>@lang('Today')
                    </option>
                    @foreach (perPeriod() as $period)
                        <option value="{{ $period }}" {{ request()->period == $period ? 'selected' : '' }}>
                            {{ __('Past ' . $period . ' days') }}</option>
                    @endforeach
                </select>
            </form>
        </div> --}}
        {{-- <div class="col-2 form_wrapper">
            <label></label>
            <div class="form-group">
                <a href="{{ route('admin.dashboard.export', ['period' => request()->input('period', 'all')]) }}"
                   class="btn btn-info form-control form_wrapper">
                    @lang('Export')
                </a>
            </div>
        </div> --}}
        {{-- <div class="form-group form_wrapper">
            <label></label>
            <button class="btn btn-success mt-4" onclick="printTable()"><i class="fa fa-print"></i> @lang('Print')</button>
        </div> --}}
    </div>

    {{-- Include other content --}}
 @include('admin.dashboard.blocks')


    </div>

@endsection

@section('popup')

@endsection

