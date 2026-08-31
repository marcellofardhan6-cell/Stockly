<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Kasir\DashboardController as KasirDashboard;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('ensure.login')
    ->name('logout');

Route::middleware('ensure.login')->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::get('/kasir/dashboard', KasirDashboard::class)
        ->middleware('role:kasir')
        ->name('kasir.dashboard');
});
