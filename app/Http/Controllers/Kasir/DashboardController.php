<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\PenjualanItem;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = session('auth_user');

        $penjualanHariIni = (int) Penjualan::whereDate('created_at', today())
            ->where('kasir', $user['name'])
            ->sum('total');

        $penjualanKemarin = (int) Penjualan::whereDate('created_at', today()->subDay())
            ->where('kasir', $user['name'])
            ->sum('total');

        $persenHarian = $penjualanKemarin > 0
            ? round(($penjualanHariIni - $penjualanKemarin) / $penjualanKemarin * 100, 1)
            : null;

        $totalTransaksi = Penjualan::whereDate('created_at', today())
            ->where('kasir', $user['name'])
            ->count();

        $produkTerjual = (int) PenjualanItem::whereHas('penjualan', function ($q) use ($user) {
            $q->whereDate('created_at', today())->where('kasir', $user['name']);
        })->sum('qty');

        // Ringkasan per jam hari ini
        $perJam = collect(range(8, 14))->map(function ($jam) use ($user) {
            $total = (int) Penjualan::whereDate('created_at', today())
                ->where('kasir', $user['name'])
                ->whereRaw('HOUR(created_at) = ?', [$jam])
                ->sum('total');

            return [
                'label' => sprintf('%02d:00', $jam),
                'value' => $total,
                'display' => $total >= 1000000
                    ? 'Rp'.number_format($total / 1000000, 1, ',', '.').'jt'
                    : 'Rp'.number_format($total / 1000, 0, ',', '.').'rb',
            ];
        });

        $transaksiTerbaru = Penjualan::with('items')
            ->where('kasir', $user['name'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('kasir.dashboard', [
            'user' => $user,
            'penjualanHariIni' => $penjualanHariIni,
            'persenHarian' => $persenHarian,
            'totalTransaksi' => $totalTransaksi,
            'produkTerjual' => $produkTerjual,
            'perJam' => $perJam,
            'transaksiTerbaru' => $transaksiTerbaru,
        ]);
    }
}