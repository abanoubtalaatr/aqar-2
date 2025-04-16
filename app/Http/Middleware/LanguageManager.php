<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class LanguageManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session()->has('applocale') and array_key_exists(Session()->get('applocale'), config('general.languages'))) {
            App::setLocale(Session()->get('applocale'));
        } else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}
