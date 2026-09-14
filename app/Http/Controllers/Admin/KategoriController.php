<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('produk')
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(KategoriRequest $request)
    {
        $kategori = Kategori::create([
            'nama' => $request->nama,
            'slug' => $this->makeSlug($request->nama),
            'category_code' => $request->category_code,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', "Kategori \"{$kategori->nama}\" berhasil ditambahkan.");
    }

    public function show(Kategori $kategori)
    {
        return redirect()->route('admin.kategori.index');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $kategori->update([
            'nama' => $request->nama,
            'slug' => $this->makeSlug($request->nama),
            'category_code' => $request->category_code,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', "Kategori \"{$kategori->nama}\" berhasil diperbarui.");
    }

    public function destroy(Request $request, Kategori $kategori)
    {
        if ($kategori->produk()->exists()) {
            $message = 'Kategori ini masih digunakan oleh produk dan tidak dapat dihapus.';

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }

            return redirect()
                ->route('admin.kategori.index')
                ->with('error', $message);
        }

        $nama = $kategori->nama;
        $kategori->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => "Kategori \"{$nama}\" dihapus."]);
        }

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', "Kategori \"{$nama}\" berhasil dihapus.");
    }

    private function makeSlug(string $nama): string
    {
        $base = Str::slug($nama) ?: 'kategori';
        $slug = $base;
        $i = 2;

        while (Kategori::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
