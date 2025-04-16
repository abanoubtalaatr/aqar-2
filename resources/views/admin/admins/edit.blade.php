@extends('admin.app')
@section('title', isset($item) ? __('dashboard.Edit Admin') : __('dashboard.Add Admin'))

@section('styles')
    <style>
        #pac-input {
            right: 60px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@yield('title')</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-tool btn-sm btn-info" title="@lang('dashboard.View all')">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form method="post" action="{{ isset($item) ? route('admin.admins.update', $item->id) : route('admin.admins.store') }}" id="frm1" enctype="multipart/form-data">
                        @csrf
                        @if(isset($item))
                            @method('PUT')
                        @endif

                        <div class="card-body row">
                            <div class="form-group col-6">
                                <label for="name">@lang('dashboard.Name')</label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name', $item->name ?? '') }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="email">@lang('dashboard.Email')</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email', $item->email ?? '') }}">
                            </div>
                        </div>

                        <div class="card-body row">
                            <div class="form-group col-6">
                                <label for="phone">@lang('dashboard.mobile')</label>
                                <input type="text" name="phone" class="form-control" required value="{{ old('phone', $item->phone ?? '') }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="role">@lang('dashboard.Role')</label>
                                <select name="role_id" class="form-control" required>
                                    <option value="">@lang('Choose Role')</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id', $item->roles->first()->id ?? '') == $role->id ? 'selected' : '' }}>
                                            {{ app()->getlocale() == 'ar' ? $role->name_ar : $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="password">{{ __('dashboard.Password') }}</label>
                                <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                                @if(isset($item))
                                    <small class="text-muted">@lang('dashboard.Leave blank if you don\'t want to change the password')</small>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">{{ __('dashboard.Confirm Password') }}</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">{{ isset($item) ? __('dashboard.Update') : __('dashboard.Add') }}</button>
                            <a href="{{ route('admin.admins.index') }}" class="btn btn-default float-right">@lang('dashboard.Cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
    </script>

    <script src="{{ dashboardAsset('maps/script.js') }}"></script>
@endsection
