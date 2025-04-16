<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectToAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('/')) {
            return redirect('/admin/admin/login');
        }

        return $next($request);
    }
}
