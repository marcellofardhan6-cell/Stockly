<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with(['produk', 'supplier'])
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('admin.barang-masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        return view('admin.barang-masuk.create', [
            'produk' => Produk::orderBy('nama')->get(),
            'supplier' => Supplier::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'produk_id' => ['required', 'integer', 'exists:produk,id'],
            'supplier_id' => ['nullable', 'integer', 'exists:supplier,id'],
            'qty' => ['required', 'integer', 'min:1'],
            'harga_beli' => ['required', 'integer', 'min:0'],
            'tanggal' => ['required', 'date'],
        ]);

        DB::transaction(function () use ($data) {
            BarangMasuk::create($data);

            $produk = Produk::lockForUpdate()->findOrFail($data['produk_id']);
            $produk->increment('stok', $data['qty']);

            // Perbarui harga beli produk mengikuti harga terakhir
            $produk->update(['harga_beli' => $data['harga_beli']]);
        });

        return redirect()
            ->route('admin.barang-masuk.index')
            ->with('success', 'Barang masuk berhasil dicatat dan stok diperbarui.');
    }

    public function destroy(Request $request, BarangMasuk $barangMasuk)
    {
        DB::transaction(function () use ($barangMasuk) {
            if ($barangMasuk->produk) {
                $produk = Produk::lockForUpdate()->find($barangMasuk->produk_id);
                if ($produk) {
                    $produk->decrement('stok', $barangMasuk->qty);
                }
            }

            $barangMasuk->delete();
        });

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Catatan barang masuk dihapus.']);
        }

        return redirect()
            ->route('admin.barang-masuk.index')
            ->with('success', 'Catatan barang masuk berhasil dihapus.');
    }
}