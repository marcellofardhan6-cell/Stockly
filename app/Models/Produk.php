<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'sku', 'nama', 'deskripsi', 'kategori_id',
        'stok', 'harga_beli', 'harga_jual', 'stok_minimal',
    ];

    protected $casts = [
        'harga_beli' => 'integer',
        'harga_jual' => 'integer',
        'stok' => 'integer',
        'stok_minimal' => 'integer',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $term
            ? $query->where('nama', 'like', "%{$term}%")
                ->orWhere('sku', 'like', "%{$term}%")
            : $query;
    }

    public function scopeMenipis(Builder $query): Builder
    {
        return $query->whereColumn('stok', '<=', 'stok_minimal');
    }

    public function getStatus(): string
    {
        if ($this->stok <= 0) {
            return 'habis';
        }

        return $this->stok <= $this->stok_minimal ? 'menipis' : 'tersedia';
    }
}
