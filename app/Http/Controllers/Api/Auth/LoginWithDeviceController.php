<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Strategies\Auth\Login\AuthContext;
use App\Strategies\Auth\Login\LoginWithDeviceId;
use Illuminate\Http\Request;

class LoginWithDeviceController extends Controller
{
    //Using Strategy pattern in authentication
    public function __invoke(AuthContext $authContext, Request $request)
    {
        $authContext->setStrategy(new LoginWithDeviceId());

        return $authContext->login($request);
    }
}
