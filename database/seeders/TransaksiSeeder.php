<?php

namespace Database\Seeders;

use App\Models\BarangMasuk;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $supplier = Supplier::firstOrCreate(
            ['nama' => 'PT Kopi Nusantara'],
            ['kontak' => 'Budi Santoso', 'telepon' => '0812-3456-7890', 'email' => 'sales@kopinusantara.id', 'alamat' => 'Jl. Raya Kopi No. 12, Bandung']
        );

        $produk = Produk::all()->keyBy('id');
        if ($produk->isEmpty()) {
            return;
        }

        // Barang masuk (stok sudah di-seed, jadi ini hanya catatan historis tanpa mengubah stok)
        $barangMasuk = [
            [1, $supplier->id, 100, 85000, now()->subDays(10)],
            [2, $supplier->id, 80, 60000, now()->subDays(9)],
            [6, $supplier->id, 20, 65000, now()->subDays(7)],
            [9, $supplier->id, 50, 15000, now()->subDays(4)],
        ];

        foreach ($barangMasuk as [$produkId, $supplierId, $qty, $harga, $tanggal]) {
            if (! isset($produk[$produkId])) {
                continue;
            }
            BarangMasuk::firstOrCreate(
                ['produk_id' => $produkId, 'tanggal' => $tanggal->toDateString(), 'qty' => $qty],
                ['supplier_id' => $supplierId, 'harga_beli' => $harga]
            );
        }

        // Penjualan 7 hari terakhir (tidak mengubah stok agar data tetap konsisten)
        $kasir = ['Rina Amelia', 'Dewi Lestari', 'Andi Pratama'];
        $items = [
            [1, 2], [3, 5], [9, 3], [4, 1], [10, 2], [8, 1], [5, 2], [7, 4],
        ];

        for ($i = 6; $i >= 0; $i--) {
            $jumlahTrx = rand(1, 3);
            for ($t = 0; $t < $jumlahTrx; $t++) {
                $tanggal = now()->subDays($i)->setTime(rand(8, 20), rand(0, 59));
                [$produkId, $qty] = $items[array_rand($items)];

                if (! isset($produk[$produkId])) {
                    continue;
                }

                $p = $produk[$produkId];
                $subtotal = $p->harga_jual * $qty;

                $penjualan = Penjualan::create([
                    'invoice' => 'INV-'.$tanggal->format('ymd').'-'.str_pad((string) rand(1, 999), 3, '0', STR_PAD_LEFT),
                    'kasir' => $kasir[array_rand($kasir)],
                    'total' => $subtotal,
                    'status' => 'lunas',
                    'created_at' => $tanggal,
                    'updated_at' => $tanggal,
                ]);

                $penjualan->items()->create([
                    'produk_id' => $p->id,
                    'nama_produk' => $p->nama,
                    'qty' => $qty,
                    'harga' => $p->harga_jual,
                    'subtotal' => $subtotal,
                ]);
            }
        }
    }
}