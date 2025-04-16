@extends('admin.app')
@section('title', __('dashboard.Edit City'))

@section('content')
    <div class="card">
        <div class="card-header">@lang('dashboard.Edit City')</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.cities.update', $city->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>@lang('dashboard.name_ar')</label>
                    <input type="text" name="name_ar" class="form-control" value="{{ $city->name_ar }}" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.name_en')</label>
                    <input type="text" name="name_en" class="form-control" value="{{ $city->name_en }}" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.latitude_min')</label>
                    <input type="text" name="latitude_min" class="form-control" value="{{ $city->latitude_min }}" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.latitude_max')</label>
                    <input type="text" name="latitude_max" class="form-control" value="{{ $city->latitude_max }}" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.longitude_min')</label>
                    <input type="text" name="longitude_min" class="form-control" value="{{ $city->longitude_min }}" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.longitude_max')</label>
                    <input type="text" name="longitude_max" class="form-control" value="{{ $city->longitude_max }}" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.latitude')</label>
                    <input type="text" name="latitude" class="form-control" value="{{ $city->latitude }}" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.longitude')</label>
                    <input type="text" name="longitude" class="form-control" value="{{ $city->longitude }}" required>
                </div>
                <div class="form-group">
                    <label>@lang('dashboard.latitude_center')</label>
                    <input type="text" name="latitude_center" class="form-control" value="{{ $city->latitude_center }}" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.longitude_center')</label>
                    <input type="text" name="longitude_center" class="form-control" value="{{ $city->longitude_center }}" required>
                </div>

                <button type="submit" class="btn btn-primary">@lang('dashboard.Update')</button>
                <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">@lang('dashboard.Cancel')</a>
            </form>
        </div>
    </div>
@endsection
