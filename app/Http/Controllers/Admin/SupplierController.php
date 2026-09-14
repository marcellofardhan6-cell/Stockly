<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::orderByDesc('updated_at')->paginate(10);

        return view('admin.supplier.index', compact('supplier'));
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        return redirect()
            ->route('admin.supplier.index')
            ->with('success', "Supplier \"{$supplier->nama}\" berhasil ditambahkan.");
    }

    public function show(Supplier $supplier)
    {
        return redirect()->route('admin.supplier.index');
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return redirect()
            ->route('admin.supplier.index')
            ->with('success', "Supplier \"{$supplier->nama}\" berhasil diperbarui.");
    }

    public function destroy(Request $request, Supplier $supplier)
    {
        $nama = $supplier->nama;
        $supplier->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => "Supplier \"{$nama}\" dihapus."]);
        }

        return redirect()
            ->route('admin.supplier.index')
            ->with('success', "Supplier \"{$nama}\" berhasil dihapus.");
    }
}
