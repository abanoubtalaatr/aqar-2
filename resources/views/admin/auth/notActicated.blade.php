<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ dashboardAsset('images/logo.webp') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ dashboardAsset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!------ Countries Flags ------>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />

    @if (myLang() == 'ar')
        <link rel="stylesheet" href="{{ dashboardAsset('cdn/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ dashboardAsset('css/rtl.css?1.0') }}">
    @endif
    <link rel="stylesheet" href="{{ dashboardAsset('css/dev.css') }}" />
    @yield('styles')
</head>

{{auth()->logout()}}

<body class="hold-transition login-page">
    <div class="login-box">
        @include('admin.partials.language_switcher')
        <div class="card card-outline card-primary">
            @include('admin.partials.messages')
            <div class="container-fluid">
                {{trans('auth.in_active_account')}}
            </div>
        </div>

    </div>

    <script src="{{ dashboardAsset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ dashboardAsset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ dashboardAsset('dist/js/adminlte.min.js') }}"></script>

    <script src="{{ dashboardAsset('cdn/jquery.validate.min.js') }}"></script>
    @if (myLang() == 'ar')
        <script src="{{ dashboardAsset('js/validation_ar.js') }}"></script>
    @else
        <script src="{{ dashboardAsset('js/validation_en.js') }}"></script>
    @endif
    <script>
        $("#frm1").validate();
    </script>

    {{-- @include('sweetalert::alert') --}}
    @yield('scripts')

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>










 