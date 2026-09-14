<?php

namespace App\Providers;

use App\Models\Produk;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        CarbonImmutable::setLocale(config('app.locale'));

        View::composer('components.app-shell', function ($view) {
            $notifStok = Produk::whereColumn('stok', '<=', 'stok_minimal')
                ->orderBy('stok')
                ->limit(4)
                ->get();

            $view->with('notifStok', $notifStok);
        });
    }
}