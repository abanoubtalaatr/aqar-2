<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function change($lang)
    {
        if (array_key_exists($lang, Config::get('general.languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }
}
