<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\PenjualanItem;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalProduk = Produk::count();
        $totalStok = (int) Produk::sum('stok');

        $penjualanHariIni = (int) Penjualan::whereDate('created_at', today())->sum('total');
        $penjualanKemarin = (int) Penjualan::whereDate('created_at', today()->subDay())->sum('total');
        $persenHarian = $penjualanKemarin > 0
            ? round(($penjualanHariIni - $penjualanKemarin) / $penjualanKemarin * 100, 1)
            : null;

        $stokMenipis = Produk::whereColumn('stok', '<=', 'stok_minimal')->count();

        // Grafik 7 hari terakhir
        $grafik = collect(range(6, 0))->map(function ($i) {
            $date = today()->subDays($i);
            $total = (int) Penjualan::whereDate('created_at', $date)->sum('total');

            return [
                'label' => $date->translatedFormat('D'),
                'value' => $total,
                'display' => $total >= 1000000
                    ? 'Rp'.number_format($total / 1000000, 1, ',', '.').'jt'
                    : 'Rp'.number_format($total / 1000, 0, ',', '.').'rb',
            ];
        });

        $produkMenipis = Produk::whereColumn('stok', '<=', 'stok_minimal')
            ->orderBy('stok')
            ->limit(5)
            ->get();

        $transaksiTerbaru = Penjualan::with('items')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'user' => session('auth_user'),
            'totalProduk' => $totalProduk,
            'totalStok' => $totalStok,
            'penjualanHariIni' => $penjualanHariIni,
            'persenHarian' => $persenHarian,
            'stokMenipis' => $stokMenipis,
            'grafik' => $grafik,
            'produkMenipis' => $produkMenipis,
            'transaksiTerbaru' => $transaksiTerbaru,
        ]);
    }
}