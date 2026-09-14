<?php

use App\Http\Controllers\Admin\BarangMasukController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Kasir\DashboardController as KasirDashboard;
use App\Http\Controllers\Kasir\PenjualanController;
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

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::resource('produk', ProdukController::class)->names('admin.produk');
        Route::resource('kategori', KategoriController::class)->names('admin.kategori');
        Route::resource('supplier', SupplierController::class)->names('admin.supplier');
        Route::resource('barang-masuk', BarangMasukController::class)
            ->only(['index', 'create', 'store', 'destroy'])
            ->names('admin.barang-masuk');
        Route::get('laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
        Route::get('laporan/{penjualan}', [LaporanController::class, 'show'])->name('admin.laporan.show');
        Route::resource('user', UserController::class)->except(['show'])->names('admin.user');
        Route::get('pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan.index');
        Route::put('pengaturan/profil', [PengaturanController::class, 'updateProfil'])->name('admin.pengaturan.profil');
        Route::put('pengaturan/password', [PengaturanController::class, 'updatePassword'])->name('admin.pengaturan.password');
    });

    Route::get('/kasir/dashboard', KasirDashboard::class)
        ->middleware('role:kasir')
        ->name('kasir.dashboard');

    Route::prefix('kasir')->middleware('role:kasir')->group(function () {
        Route::get('penjualan', [PenjualanController::class, 'index'])->name('kasir.penjualan.index');
        Route::get('penjualan/baru', [PenjualanController::class, 'create'])->name('kasir.penjualan.create');
        Route::post('penjualan', [PenjualanController::class, 'store'])->name('kasir.penjualan.store');
        Route::get('penjualan/{penjualan}', [PenjualanController::class, 'show'])->name('kasir.penjualan.show');
    });
});