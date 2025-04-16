<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Strategies\Auth\Login\AuthContext;
use App\Strategies\Auth\Login\LoginWithCredentials;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //Using Strategy pattern in authentication
    public function __invoke(AuthContext $authContext, Request $request)
    {
        $authContext->setStrategy(new LoginWithCredentials());

        return $authContext->login($request);
    }
}
