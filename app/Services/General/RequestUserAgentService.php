<?php

namespace App\Services\General;

use Illuminate\Http\Request;

class RequestUserAgentService
{
    public static function getUserAgent(Request $request)
    {
        $agent = $request->userAgent();
        $clientType = explode('/', $agent)[0]; // Extract the first word before "/"

        $mobileClients = ['dart', 'flutter'];
        $webClients = ['mozilla', 'chrome', 'safari'];
        $postmanClients = ['postmanruntime'];

        if (in_array(strtolower($clientType), $mobileClients)) {
            $clientCategory = 'mobile';
        } elseif (in_array(strtolower($clientType), $webClients)) {
            $clientCategory = 'web';
        } elseif (in_array(strtolower($clientType), $postmanClients)) {
            $clientCategory = 'postman';
        } else {
            $clientCategory = 'unknown';
        }

        return $clientCategory;
    }
}
