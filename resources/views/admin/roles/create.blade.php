@extends('admin.app')
@section('title', __('dashboard.Add Role'))

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
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-tool btn-sm btn-info"
                            title="@lang('dashboard.View all')">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form method="post" action="{{ route('admin.roles.store') }}" id="frm1"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">@lang('dashboard.name')</label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="name">@lang( 'dashboard.name_ar')</label>
                                <input type="text" name="name_ar" class="form-control" required value="{{ old('name_ar') }}">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="permissions">@lang('dashboard.Permissions')</label>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                id="permission_{{ $permission->id }}" class="form-check-input"
                                                {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                            <label for="permission_{{ $permission->id }}" class="form-check-label">
                                                @lang('dashboard.'. $permission->name)
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">@lang('dashboard.Add')</button>
                            <a href="{{ route('admin.roles.index') }}"
                                class="btn btn-default float-right">@lang('dashboard.Cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        // JavaScript to handle "Select All" functionality for permissions
        document.getElementById('select_all').addEventListener('click', function() {
            var checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = event.target.checked;
            });
        });
    </script>
@endsection