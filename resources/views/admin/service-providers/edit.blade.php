
@extends('admin.app')
@section('title', __('dashboard.Edit Service Provider'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.Edit Service Provider')</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.service-providers.update', $serviceProvider->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="service_type">@lang('dashboard.Service Type')</label>
                            <select name="service_type_id" id="service_type" class="form-control" required>
                                <option value="" disabled>@lang('dashboard.select')</option>
                                @foreach ($serviceTypes as $type)
                                    <option value="{{ $type->id }}" {{ $serviceProvider->service_type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="emails">@lang('dashboard.Emails (Separate with commas)')</label>
                            <input type="text" name="emails" id="emails" class="form-control" value="{{ $serviceProvider->emails }}" required placeholder="email1@example.com, email2@example.com">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('dashboard.Update')</button>
                            <a href="{{ route('admin.service-providers.index') }}" class="btn btn-default">@lang('dashboard.Cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection