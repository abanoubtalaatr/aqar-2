@extends('site.app')
@section('title', __('Privacy Policy'))
@section('styles')

@endsection
@section('content')

    <section class="services" style="margin-top: 90px;">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-5">
                    <div class="img_box">
                        <img src="{{ asset('front/images/4.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="hero_info">
                        @include('admin.partials.messages')

                        <h2>@lang('Privacy Policy')</h2>

                        {!! $item['body_' . myLang()] !!}


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection
