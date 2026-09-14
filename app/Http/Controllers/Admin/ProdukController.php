<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::with('kategori')
            ->search($request->get('q'));

        $status = strtolower((string) $request->get('status'));
        if ($status === 'habis') {
            $produk->where('stok', 0);
        } elseif ($status === 'menipis') {
            $produk->where('stok', '>', 0)->whereColumn('stok', '<=', 'stok_minimal');
        } elseif ($status === 'tersedia') {
            $produk->whereColumn('stok', '>', 'stok_minimal');
        }

        $produk = $produk->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.produk.index', [
            'produk' => $produk,
            'status' => $status,
        ]);
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama')->get();

        $skuPreview = $kategori->mapWithKeys(
            fn (Kategori $kat) => [$kat->id => $kat->nextSku()]
        );

        return view('admin.produk.create', [
            'kategori' => $kategori,
            'skuPreview' => $skuPreview,
            'generateSku' => true,
        ]);
    }

    public function store(ProdukRequest $request)
    {
        $data = $request->validated();
        $data['sku'] = Kategori::findOrFail($data['kategori_id'])->nextSku();

        $produk = Produk::create($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', "Produk \"{$produk->nama}\" (SKU {$produk->sku}) berhasil ditambahkan.");
    }

    public function show(Produk $produk)
    {
        $produk->load('kategori');

        return view('admin.produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('admin.produk.edit', [
            'produk' => $produk,
            'kategori' => Kategori::orderBy('nama')->get(),
            'generateSku' => false,
        ]);
    }

    public function update(ProdukRequest $request, Produk $produk)
    {
        $produk->update($request->validated());

        return redirect()
            ->route('admin.produk.index')
            ->with('success', "Produk \"{$produk->nama}\" berhasil diperbarui.");
    }

    public function destroy(Request $request, Produk $produk)
    {
        $nama = $produk->nama;
        $produk->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => "Produk \"{$nama}\" dihapus."]);
        }

        return redirect()
            ->route('admin.produk.index')
            ->with('success', "Produk \"{$nama}\" berhasil dihapus.");
    }
}
