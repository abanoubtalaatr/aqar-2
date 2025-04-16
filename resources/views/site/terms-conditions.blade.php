<!DOCTYPE html>
<html lang="en">
<!-- Start head -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title> </title> -->

    <link rel="shortcut icon" href="#">
    <!-- bootstrap included -->
    <link rel="stylesheet" href="{{ asset('website/' . app()->getLocale() . '/assets/css/bootstrap.min.css') }}">
    <!-- font Awesome  library -->
    <link rel="stylesheet" href="{{ asset('website/' . app()->getLocale() . '/assets/css/all.min.css') }}">
    <!-- start slick slider -->
    <link rel="stylesheet" href="{{ asset('website/' . app()->getLocale() . '/assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('website/' . app()->getLocale() . '/assets/css/slick.css') }}">
    <!-- start css file -->
    <link rel="stylesheet" href="{{ asset('website/' . app()->getLocale() . '/assets/css/style.css') }}">
    <!-- start responsive -->
    <link rel="stylesheet" href="{{ asset('website/' . app()->getLocale() . '/assets/css/responsive.css') }}">

</head>
<!-- start body -->

<body>
    @include('site.navbar')
    <!-- start terms  -->
    <div class="container">
        <div class="terms border rounded p-3">

            <h4 class="mb-3">{!! app()->getLocale() =='ar' ? $item->name_ar : $item->name_en !!}</h4>
          <p>
            {!! app()->getLocale() =='ar' ? $item->body_ar : $item->body_en !!}
          </p>
        </div>
    </div>
    @include('site.footer')
</body>
<!-- end of body -->

</html>
<!-- end of code -->