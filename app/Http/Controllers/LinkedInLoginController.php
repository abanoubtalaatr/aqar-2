<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LinkedInLoginController extends Controller
{
    public function login(Request $request, $client)
    {

        $redirectUrl = env('LINKEDIN_REDIRECT_URL');
        $clientId = env('LINKEDIN_CLIENT_ID');

        //        return Redirect::away("https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=$clientId&redirect_uri=$redirectUrl&state=$client&scope=openid profile email");

        return response()->json([
            'data' => "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=$clientId&redirect_uri=$redirectUrl&state=$client&scope=openid profile email",
        ]);
    }

    public function callback(Request $request)
    {

        if ($request->input('code')) {
            $code = $request->input('code');
            $url = env("LINKEDIN_REDIRECT_URL");
            $clientId = env('LINKEDIN_CLIENT_ID');
            $secret = env('LINKEDIN_SECRET_KEY');

            $response = Http::post("https://www.linkedin.com/oauth/v2/accessToken?grant_type=authorization_code&code=$code&redirect_uri=$url&client_id=$clientId&client_secret=$secret");

            $accessToken = json_decode($response->body())->access_token;

            $url = "https://api.linkedin.com/v2/userinfo";

            $client = new Client();
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);

                $user = \App\Models\User::where('email', $data['email'])->first();



            }
        }
    }
}
