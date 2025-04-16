@extends('admin.app')
@section('title', __('dashboard.Add Random Message'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-transparent">
                {{-- <h3 class="card-title">@yield('title')</h3> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.random-messages.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>@lang('dashboard.Name (Arabic)')</label>
                        <input type="text" name="name_ar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('dashboard.Name (English)')</label>
                        <input type="text" name="name_en" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-info">@lang('dashboard.Add')</button>
                    <a href="{{ route('admin.random-messages.index') }}" class="btn btn-default">@lang('dashboard.Cancel')</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
