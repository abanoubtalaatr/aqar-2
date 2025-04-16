<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ dashboardAsset('images/logo.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ dashboardAsset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
        href="{{ dashboardAsset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/summernote/summernote-bs4.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!------ Countries Flags ------>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
    <link rel="stylesheet" href="{{ dashboardAsset('cdn/font-awesome_5.13.0_css_all.min.css') }}">

    @if (myLang() == 'ar')
        <link rel="stylesheet" href="{{ dashboardAsset('cdn/bootstrap_rtl.min.css') }}">
        <link rel="stylesheet" href="{{ dashboardAsset('css/rtl.css') }}">
    @else
        <link rel="stylesheet" href="{{ dashboardAsset('css/dev.css') }}" />
    @endif
    @yield('styles')
    

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.profile') }}" class="d-block">
                        {{-- <img src="{{ auth()->user()?->photo ? asset(auth()->user()?->photo) : dashboardAsset('images/logo.svg') }}" --}}
                        {{-- style="border: 1px solid grey; width:40px; border-radius: 19%;"  alt="User Image"> --}}
                    </a>
                </li>
                @include('admin.partials.language_switcher')

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logOut') }}" title="@lang('Signout')">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4"
            style="overflow-y:auto !important; height :unset !important;">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
                {{-- <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : dashboardAsset('images/logo.svg') }}" --}}
                {{-- alt="{{ env('APP_NAME') }}" class="" style="opacity: .8"> --}}
                <!-- <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span> -->
            </a>

            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                @include('admin.partials.sidebar')
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('admin.partials.bread_crumb')

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @include('admin.partials.messages')
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>


        <footer class="main-footer text-center">
            <strong>@lang('Copyright') &copy; {{ date('Y') }} <a
                    href="{{ url('/') }}">{{ env('APP_NAME') }}</a></strong>
        </footer>

    </div>

    @include('admin.partials.new_reservation_popup')
    @yield('popup')
    <script src="{{ dashboardAsset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ dashboardAsset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="{{ dashboardAsset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ dashboardAsset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ dashboardAsset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ dashboardAsset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ dashboardAsset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ dashboardAsset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ dashboardAsset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ dashboardAsset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ dashboardAsset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ dashboardAsset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ dashboardAsset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ dashboardAsset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ dashboardAsset('dist/js/pages/dashboard.js') }}"></script>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableResponsive = document.getElementById('tableResponsive');
            const isArabic = '{{ app()->getLocale() }}' === 'ar';

            if (isArabic) {
                // For Arabic: Start scrollbar from the right
                tableResponsive.scrollLeft = tableResponsive.scrollWidth - tableResponsive.clientWidth;
            } else {
                // For English: Start scrollbar from the left
                tableResponsive.scrollLeft = 0;
            }
        });
    </script>
    @yield('scripts')

    <script>
        function readURL(input, img_id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var logo_id = $('#' + img_id);
                reader.onload = function(e) {
                    logo_id.attr('src', e.target.result);
                };
                logo_id.css("width", "400px");
                logo_id.css("height", "200px");
                reader.readAsDataURL(input.files[0]);
            }

        }
    </script>
</body>

</html>
