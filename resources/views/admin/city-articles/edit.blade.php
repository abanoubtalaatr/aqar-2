@extends('admin.app')
@section('title', __('dashboard.Edit City'))

@section('content')
    <div class="card">
        <div class="card-header">@lang('dashboard.Edit City')</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.cities-articles.update', $city->id) }}">
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


                <button type="submit" class="btn btn-primary">@lang('dashboard.Update')</button>
                <a href="{{ route('admin.cities-articles.index') }}" class="btn btn-secondary">@lang('dashboard.Cancel')</a>
            </form>
        </div>
    </div>
@endsection