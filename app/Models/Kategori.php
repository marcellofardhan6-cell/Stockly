<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = ['nama', 'slug', 'category_code', 'deskripsi'];

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }

    public function getPrefix(): string
    {
        return strtoupper($this->category_code);
    }

    /**
     * Generate SKU berikutnya untuk kategori ini dengan sequence yang aman.
     * Menggunakan nomor terbesar yang pernah dipakai (bukan jumlah produk)
     * sehingga aman meskipun ada produk yang dihapus.
     */
    public function nextSku(): string
    {
        $prefix = $this->getPrefix().'-';

        $terakhir = Produk::where('sku', 'like', $prefix.'%')
            ->pluck('sku')
            ->map(function (string $sku) use ($prefix) {
                $angka = substr($sku, strlen($prefix));

                return is_numeric($angka) ? (int) $angka : 0;
            })
            ->max() ?? 0;

        return $prefix.str_pad((string) ($terakhir + 1), 4, '0', STR_PAD_LEFT);
    }
}
