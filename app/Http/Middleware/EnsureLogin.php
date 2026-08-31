<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('auth_user')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
