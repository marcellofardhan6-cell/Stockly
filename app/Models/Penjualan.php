<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjualan extends Model
{
    protected $table = 'penjualan';

    protected $fillable = ['invoice', 'kasir', 'total', 'status', 'metode_bayar', 'uang_diterima', 'kembalian', 'diskon', 'subtotal'];

    protected $casts = [
        'total' => 'integer',
        'uang_diterima' => 'integer',
        'kembalian' => 'integer',
        'diskon' => 'integer',
        'subtotal' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PenjualanItem::class, 'penjualan_id');
    }

    public function getTotalQty(): int
    {
        return (int) $this->items->sum('qty');
    }
}