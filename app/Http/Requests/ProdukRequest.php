<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ($this->session()->get('auth_user')['role'] ?? null) === 'admin';
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kategori_id' => ['required', 'exists:kategori,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga_beli' => ['required', 'integer', 'min:0'],
            'harga_jual' => ['required', 'integer', 'min:0'],
            'stok_minimal' => ['required', 'integer', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama produk',
            'deskripsi' => 'Deskripsi',
            'kategori_id' => 'Kategori',
            'stok' => 'Stok',
            'harga_beli' => 'Harga beli',
            'harga_jual' => 'Harga jual',
            'stok_minimal' => 'Stok minimal',
        ];
    }
}
