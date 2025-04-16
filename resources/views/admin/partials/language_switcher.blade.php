@foreach (Config::get('general.languages') as $lang => $language)
    @if ($lang != App::getLocale())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('changeLang', $lang) }}">                 
                {!! countryFlag($lang) !!}                 
                {{ $language }}
            </a>
        </li>
    @endif
@endforeach
