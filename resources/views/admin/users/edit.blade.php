@extends('admin.app')
@section('title', __('dashboard.Edit user'))

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
                        <a href="{{ route('admin.users.index') }}" class="btn btn-tool btn-sm btn-info"
                            title="@lang('View all')">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form  method="post" action="{{ route('admin.users.update', ['user' => $item->id]) }}" id="frm1"
                        enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="id" class="form-control" value="{{old('id', $item->id)}}">
                        <div class="card-body row">
                            <div class="form-group col-6">
                                <label for="name">@lang('dashboard.username')</label>
                                <input type="text" name="name" class="form-control" required
                                    value="{{old('name', $item->name)}}" >
                            </div>
                            <div class="form-group col-6">
                                <label for="email">@lang('dashboard.email')</label>
                                <input type="email" name="email" class="form-control" value="{{old('email', $item->email)}}">
                            </div>
                        </div>
                        <div class="card-body row">
                            <div class="form-group col-6">
                                <label for="name">@lang('dashboard.mobile')</label>
                                <input type="text" name="phone" class="form-control" required
                                    value="{{old('phone', $item->phone)}}" >
                            </div>
                            
                        </div>
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="password">{{__('dashboard.password')}}</label>
                                <input type="password"  class="form-control"  autocomplete="off" name="password" id="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">@lang('dashboard.Confirm Password')</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">@lang('dashboard.Update')</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-default float-right">@lang('dashboard.Cancel')</a>
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
