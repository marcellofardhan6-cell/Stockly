<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->session()->get('auth_user');

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user['role'] !== $role) {
            return redirect()->route($user['role'] === 'admin' ? 'admin.dashboard' : 'kasir.dashboard');
        }

        return $next($request);
    }
}
