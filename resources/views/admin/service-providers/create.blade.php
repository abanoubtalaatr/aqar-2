
@extends('admin.app')
@section('title', __('dashboard.Create Service Provider'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.Create Service Provider')</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.service-providers.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="service_type">@lang('dashboard.Service Type')</label>
                            <select name="service_type_id" id="service_type" class="form-control" required>
                                <option value="" selected disabled>@lang('dashboard.select')</option>
                                @foreach ($serviceTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="emails">@lang('dashboard.Emails (Separate with commas)')</label>
                            <input type="text" name="emails" id="emails" class="form-control" required placeholder="email1@example.com, email2@example.com">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('dashboard.save')</button>
                            <a href="{{ route('admin.service-providers.index') }}" class="btn btn-default">@lang('dashboard.Cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection