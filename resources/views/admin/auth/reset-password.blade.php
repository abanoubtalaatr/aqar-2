@extends('admin.auth.app')
@section('title', __('Reset Password'))
@section('content')
    <div class="card-body">
        <p class="login-box-msg">@lang('Reset Password')</p>

        <form method="post" action="{{ route('admin.resetPassword.submit') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>

                <input type="email" name="email" class="form-control" placeholder="@lang('Email')"
                    value="{{ old('email') }}" required autofocus>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>

                <input type="password" name="password" class="form-control" placeholder="@lang('Password')" required
                    autofocus>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>

                <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('Password Confirm')"
                    required autofocus>
            </div>

            <div class="row">
                <div class="">
                    <button type="submit" class="btn btn-primary btn-block">@lang('Reset Password')</button>
                </div>

            </div>
        </form>

        <hr />
        <p class="mb-1">
            <a href="{{ route('admin.login') }}"><u>@lang('Already Registered?')</u></a>
        </p>
    </div>
@endsection
