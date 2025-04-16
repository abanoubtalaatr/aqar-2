@extends('admin.app')
@section('title', __('dashboard.Add City'))

@section('content')
    <div class="card">
        <div class="card-header">@lang('dashboard.Add City')</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.cities.store') }}">
                @csrf

                <!-- General Fields -->
                <div class="form-group">
                    <label>@lang('dashboard.name_ar')</label>
                    <input type="text" name="name_ar" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.name_en')</label>
                    <input type="text" name="name_en" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.latitude_min')</label>
                    <input type="text" name="latitude_min" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.latitude_max')</label>
                    <input type="text" name="latitude_max" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>@lang('dashboard.latitude')</label>
                    <input type="text" name="latitude" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.longitude')</label>
                    <input type="text" name="longitude" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.longitude_min')</label>
                    <input type="text" name="longitude_min" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>@lang('dashboard.longitude_max')</label>
                    <input type="text" name="longitude_max" class="form-control" required>
                </div>

                <!-- Developer Section -->
                <div class="developer-section mt-4 p-3 border rounded bg-light">
                    

                    <div class="form-group">
                        <label>@lang('dashboard.latitude_center')</label>
                        <input type="text" name="latitude_center" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>@lang('dashboard.longitude_center')</label>
                        <input type="text" name="longitude_center" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">@lang('dashboard.Add')</button>
                <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary mt-3">@lang('dashboard.Cancel')</a>
            </form>
        </div>
    </div>
@endsection