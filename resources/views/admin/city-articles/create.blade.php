@extends('admin.app')
@section('title', __('dashboard.add article city'))

@section('content')
    <div class="card">
        <div class="card-header">@lang('dashboard.add article city')</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.cities-articles.store') }}">
                @csrf

                <div class="form-group">
                    <label>@lang('dashboard.name_ar')</label>
                    <input type="text" name="name_ar" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.name_en')</label>
                    <input type="text" name="name_en" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">@lang('dashboard.Add')</button>
                <a href="{{ route('admin.cities-articles.index') }}" class="btn btn-secondary">@lang('dashboard.Cancel')</a>
            </form>
        </div>
    </div>
@endsection