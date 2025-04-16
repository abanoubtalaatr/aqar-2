<!-- start header -->
<header>
    <!-- start navbar -->
    @include('site.navbar')

    <!-- strat hero section -->
    <section class="hero" id="up">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero-info">

                        <h1>@lang('Here art meets execution for Ajmal')</h1>
                        <h1> @lang('')</h1>
                        <p>@lang('Discover the latest version of the Zabatny application') </p>
                        <div class="mt-4">
                            <a href="{{ setting('android') }}" target="_blank" class=" "><img
                                    src="{{ asset('website/ar/assets/images/badg.png') }}" alt=""></a>
                            <a href="{{ setting('ios') }}" target="_blank" class=" "><img
                                    src="{{ asset('website/ar/assets/images/badge2.png') }}" alt=""></a>

                        </div>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="hero-box">
                        <img src="{{ asset('website/ar/assets/images/up.png') }}" alt="" class="up">
                    </div>
                </div>

            </div>
        </div>
    </section>
</header>