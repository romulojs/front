<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('usersession')) {
            return redirect('/');
        }

        return $next($request);
    }

}