<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private const ACCOUNTS = [
        ['email' => 'admin@stockly.id', 'password' => 'password123', 'name' => 'Budi Santoso', 'role' => 'admin'],
        ['email' => 'kasir@stockly.id', 'password' => 'password123', 'name' => 'Rina Amelia', 'role' => 'kasir'],
    ];

    public function create()
    {
        if ($user = session('auth_user')) {
            return redirect()->route($user['role'] === 'admin' ? 'admin.dashboard' : 'kasir.dashboard');
        }

        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $account = collect(self::ACCOUNTS)->first(
            fn ($account) => $account['email'] === $credentials['email']
                && $account['password'] === $credentials['password']
        );

        if (! $account) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('auth_user', [
            'name' => $account['name'],
            'email' => $account['email'],
            'role' => $account['role'],
        ]);

        return redirect()->route($account['role'] === 'admin' ? 'admin.dashboard' : 'kasir.dashboard');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('auth_user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
