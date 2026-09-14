<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\PenjualanItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $penjualan = Penjualan::with('items')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('kasir.penjualan.index', [
            'penjualan' => $penjualan,
            'user' => session('auth_user'),
        ]);
    }

    public function create(Request $request)
    {
        $produk = Produk::with('kategori')
            ->where('stok', '>', 0)
            ->orderBy('nama')
            ->get();

        return view('kasir.penjualan.create', [
            'produk' => $produk,
            'user' => session('auth_user'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.produk_id' => ['required', 'integer', 'exists:produk,id'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'metode_bayar' => ['required', 'in:tunai,transfer,qris'],
            'uang_diterima' => ['required', 'integer', 'min:0'],
            'diskon' => ['nullable', 'integer', 'min:0'],
        ]);

        $user = session('auth_user');

        try {
            $penjualan = DB::transaction(function () use ($data, $user) {
                $subtotal = 0;
                $itemsData = [];

                foreach ($data['items'] as $item) {
                    $produk = Produk::lockForUpdate()->findOrFail($item['produk_id']);

                    if ($produk->stok < $item['qty']) {
                        throw new \RuntimeException("Stok \"{$produk->nama}\" tidak mencukupi (tersisa {$produk->stok}).");
                    }

                    $subtotal += $produk->harga_jual * $item['qty'];

                    $itemsData[] = [
                        'produk_id' => $produk->id,
                        'nama_produk' => $produk->nama,
                        'qty' => $item['qty'],
                        'harga' => $produk->harga_jual,
                        'subtotal' => $produk->harga_jual * $item['qty'],
                    ];

                    $produk->decrement('stok', $item['qty']);
                }

                $diskon = (int) ($data['diskon'] ?? 0);
                $total = max(0, $subtotal - $diskon);
                $uangDiterima = (int) $data['uang_diterima'];

                if ($data['metode_bayar'] === 'tunai' && $uangDiterima < $total) {
                    throw new \RuntimeException('Uang diterima kurang dari total belanja (Rp'.number_format($total, 0, ',', '.').').');
                }

                $kembalian = $data['metode_bayar'] === 'tunai' ? max(0, $uangDiterima - $total) : 0;
                $uangDiterimaFinal = $data['metode_bayar'] === 'tunai' ? $uangDiterima : $total;

                $penjualan = Penjualan::create([
                    'invoice' => $this->makeInvoice(),
                    'kasir' => $user['name'],
                    'subtotal' => $subtotal,
                    'diskon' => $diskon,
                    'total' => $total,
                    'metode_bayar' => $data['metode_bayar'],
                    'uang_diterima' => $uangDiterimaFinal,
                    'kembalian' => $kembalian,
                    'status' => 'lunas',
                ]);

                foreach ($itemsData as $itemData) {
                    $penjualan->items()->create($itemData);
                }

                return $penjualan;
            });
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()
            ->route('kasir.penjualan.show', $penjualan)
            ->with('success', "Transaksi {$penjualan->invoice} berhasil disimpan.");
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load('items.produk');

        return view('kasir.penjualan.show', [
            'penjualan' => $penjualan,
            'user' => session('auth_user'),
        ]);
    }

    private function makeInvoice(): string
    {
        $today = now()->format('ymd');
        $prefix = "INV-{$today}-";

        $last = Penjualan::where('invoice', 'like', $prefix.'%')
            ->orderByDesc('invoice')
            ->value('invoice');

        $next = $last ? ((int) substr($last, strlen($prefix))) + 1 : 1;

        return $prefix.str_pad((string) $next, 3, '0', STR_PAD_LEFT);
    }
}