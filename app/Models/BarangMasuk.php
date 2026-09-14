<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';

    protected $fillable = ['produk_id', 'supplier_id', 'qty', 'harga_beli', 'tanggal'];

    protected $casts = [
        'qty' => 'integer',
        'harga_beli' => 'integer',
        'tanggal' => 'date',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function getTotal(): int
    {
        return $this->qty * $this->harga_beli;
    }
}