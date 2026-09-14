<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjualanItem extends Model
{
    protected $table = 'penjualan_item';

    protected $fillable = ['penjualan_id', 'produk_id', 'nama_produk', 'qty', 'harga', 'subtotal'];

    protected $casts = [
        'qty' => 'integer',
        'harga' => 'integer',
        'subtotal' => 'integer',
    ];

    public function penjualan(): BelongsTo
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}