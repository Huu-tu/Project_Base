<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CusTomAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasCookie('asscess-token')){
            return redirect('/');
        }
        return $next($request);
    }
}
