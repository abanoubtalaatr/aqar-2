<?php

namespace App\Strategies\Auth\Login;

use Illuminate\Http\Request;

interface AuthStrategyInterface
{
    public function login(Request $request);
}
