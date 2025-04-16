@extends('admin.auth.app')

@section('title', __('Login'))

@section('content')
    <div class="card-body">
        <p class="login-box-msg">{{ __('dashboard.Sign to login dashboard') }}</p>

        <form action="{{ route('admin.submitLogin') }}" method="post" id="frm1">
            @csrf

            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="fa fa-phone"></i>
                    </div>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}"
                    value="{{ old('email') }}" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        {{-- <span class="fas fa-lock"></span> --}}
                        <i class="far fa-eye" id="togglePassword"
                            style="margin-top: 0px;margin-left:0px;margin-right:0px;"></i>
                    </div>
                </div>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="{{ __('dashboard.Password') }}" required>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            @lang('dashboard.Remember Me')
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">@lang('dashboard.Sign In')</button>
                </div>
                <!-- /.col -->

                <!-- <div class="col-12">
                    <a class="btn" href="{{ url('auth/google') }}"
                        style="background: #9e49ff; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                        Login with Google
                    </a>
                </div> -->
            </div>
        </form>
        <hr />

        <p class="mb-1">
            <a href="{{ route('admin.forgetPassword') }}">@lang('dashboard.Forget Password!')</a>
        </p>
        {{-- <p class="mb-0">
      <a href="register.html" class="text-center">Register a new membership</a>
    </p> --}}
    </div>

@endsection

@section('scripts')


@endsection
