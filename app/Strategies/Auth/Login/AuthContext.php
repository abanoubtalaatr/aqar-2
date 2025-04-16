<?php

namespace App\Strategies\Auth\Login;

use Illuminate\Http\Request;

class AuthContext
{
    private AuthStrategyInterface $strategy;

    public function setStrategy(AuthStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function login(Request $request)
    {
        return $this->strategy->login($request);
    }
}
