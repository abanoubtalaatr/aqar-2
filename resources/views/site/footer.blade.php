<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <a href="#">
                    <img src="{{ asset('website/ar/assets/images/logo.png') }}" alt="">
                </a>
                <ul class="d-flex justify-content-center my-3">
                    <li>
                        <a href="#">
                            @lang('home')
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            @lang('features')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacy_policy') }}">
                            @lang('Privacy policy')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms_conditions') }}">
                            @lang('Terms and Conditions')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}">
                            @lang('About')
                        </a>
                    </li>
                </ul>
                <div class="footer-info">
                    <img height="100" class="mada-logo" src="{{ asset('default/mada.svg') }}" alt="">

                    <h6>@lang('All rights reserved') {{ now()->year }}</h6>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- start scripts included -->
<!-- bootstrap included -->
<script src="{{ asset('website/' . app()->getLocale() . '/assets/js/bootstrap.bundle.js') }}"></script>
<!-- jquery included -->
<script src="{{ asset('website/' . app()->getLocale() . '/assets/js/jquery.js') }}"></script>
<!-- slick slider -->
<script src="{{ asset('website/' . app()->getLocale() . '/assets/js/slick.min.js') }}"></script>
<!-- font awesome included -->
<script src="{{ asset('website/' . app()->getLocale() . '/assets/js/all.min.js') }}"></script>
<!-- MY code included -->
<script src="{{ asset('website/' . app()->getLocale() . '/assets/js/code.js') }}"></script>
<script>
    $('.responsive').slick({
        dots: true,
        infinite: true,
        rtl: {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                arrows: false,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                arrows: false,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });
</script>

<style>
    footer .footer-info {
    display: flex;
    flex-direction: column;
    align-items: center;
}

footer .footer-info .mada-logo {
    max-height: 100px; /* Adjust the height as needed */
    width: auto;
    
}

footer .footer-info h6 {
    margin: 0;
}

</style>



