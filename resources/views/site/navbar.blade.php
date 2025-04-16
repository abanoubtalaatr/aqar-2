<nav class="navbar navbar-expand-lg navbar-light bg-light py-2 shadow-sm">
    <div class="container">
        <a class="navbar-brand " href="/"><img src="{{ asset('website/ar/assets/images/logo.png') }}"
                alt=""></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">@lang('home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">@lang('features')</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="/">@lang('About')</a>
                </li> --}}
                <li>
                    <a class="nav-link" href="{{route('privacy_policy')}}"> @lang('Privacy policy')</a>

                </li>
                <li>
                    <a class="nav-link" href="{{route('terms_conditions')}}"> @lang('Terms and Conditions')</a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('about')}}"> @lang('About')</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }} <i class="fa-solid fa-globe"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if (app()->getLocale() == 'en')
                            <li><a class="dropdown-item" href="{{ route('changeLang', 'ar') }}">العربية</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('changeLang', 'en') }}">English</a></li>
                        @endif
                    </ul>
                </li>



            </ul>
            <ul class="navbar-nav me-auto">


                <li class="nav-item">
                    <a class="nav-link btn btn-1 px-3 py-2 text-white"
                        href="{{ setting('android') }}">@lang('Download now') <svg
                            class="svg-inline--fa fa-download mx-2" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="download" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M480 352h-133.5l-45.25 45.25C289.2 409.3 273.1 416 256 416s-33.16-6.656-45.25-18.75L165.5 352H32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h448c17.67 0 32-14.33 32-32v-96C512 366.3 497.7 352 480 352zM432 456c-13.2 0-24-10.8-24-24c0-13.2 10.8-24 24-24s24 10.8 24 24C456 445.2 445.2 456 432 456zM233.4 374.6C239.6 380.9 247.8 384 256 384s16.38-3.125 22.62-9.375l128-128c12.49-12.5 12.49-32.75 0-45.25c-12.5-12.5-32.76-12.5-45.25 0L288 274.8V32c0-17.67-14.33-32-32-32C238.3 0 224 14.33 224 32v242.8L150.6 201.4c-12.49-12.5-32.75-12.5-45.25 0c-12.49 12.5-12.49 32.75 0 45.25L233.4 374.6z">
                            </path>
                        </svg><!-- <i class="fas fa-download mx-2"></i> Font Awesome fontawesome.com --></a>
                </li>


            </ul>
        </div>
    </div>
</nav>
