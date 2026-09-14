<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $penjualan = Penjualan::with('items')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $totalPenjualan = Penjualan::sum('total');
        $totalTransaksi = Penjualan::count();
        $produkTerjual = (int) \App\Models\PenjualanItem::sum('qty');

        $stokMenipis = Produk::whereColumn('stok', '<=', 'stok_minimal')
            ->orderBy('stok')
            ->get();

        $produkTerlaris = \App\Models\PenjualanItem::selectRaw('nama_produk, SUM(qty) as total_qty, SUM(subtotal) as total_nilai')
            ->groupBy('nama_produk')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        return view('admin.laporan.index', [
            'penjualan' => $penjualan,
            'totalPenjualan' => $totalPenjualan,
            'totalTransaksi' => $totalTransaksi,
            'produkTerjual' => $produkTerjual,
            'stokMenipis' => $stokMenipis,
            'produkTerlaris' => $produkTerlaris,
        ]);
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load('items.produk');

        return view('admin.laporan.show', compact('penjualan'));
    }
}