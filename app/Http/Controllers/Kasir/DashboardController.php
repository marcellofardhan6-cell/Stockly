<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('kasir.dashboard', [
            'user' => session('auth_user'),
        ]);
    }
}
