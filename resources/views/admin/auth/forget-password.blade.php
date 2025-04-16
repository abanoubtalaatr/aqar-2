@extends('admin.auth.app')
@section('title', __('dashboard.Forget Password'))
@section('content')
    <div class="card-body">
        <p class="login-box-msg">@lang('dashboard.Forget Password')</p>

        <form method="post" action="{{ route('admin.forgetPassword.submit') }}">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <input type="email" name="email" class="form-control" placeholder="@lang('dashboard.Email')"
                    value="{{ old('email') }}" required>
            </div>

            <div class="row">
                <div class="">
                    <button type="submit" class="btn btn-primary">@lang('dashboard.Send Password Reset Link')</button>
                </div>

            </div>
        </form>

        <hr />
    <p class="mb-1">
        <a href="{{ route('admin.login') }}"><u>@lang('dashboard.Already Registered?')</u></a>
    </p>

    </div>
@endsection
