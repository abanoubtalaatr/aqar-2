<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ dashboardAsset('cdn/ionicons.min.css') }}">
    <link rel="stylesheet"
        href="{{ dashboardAsset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ dashboardAsset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ dashboardAsset('plugins/summernote/summernote-bs4.min.css') }}">

    @if (myLang() == 'ar')
        <link rel="stylesheet" href="{{ dashboardAsset('cdn/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ dashboardAsset('css/rtl.css?1.0') }}">
    @endif

    <link rel="stylesheet" href="{{ dashboardAsset('css/dev.css?1.0') }}" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="content-wrapper">

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>

</html>
