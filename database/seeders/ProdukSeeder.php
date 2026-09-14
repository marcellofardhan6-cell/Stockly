<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $bySlug = Kategori::pluck('id', 'slug');

        $produk = [
            ['kopi', 'Kopi Arabica Biji 1kg', 'Biji kopi arabica grade A, sangrai medium.', 128, 85000, 125000],
            ['kopi', 'Kopi Robusta Biji 1kg', 'Biji kopi robusta sangrai dark.', 96, 60000, 95000],
            ['kopi', 'Kopi Arabica Bubuk 250g', 'Bubuk kopi arabica siap seduh.', 210, 30000, 48000],
            ['peralatan-minum', 'Mug Keramik Putih Matte', 'Mug keramik 350ml finishing matte.', 42, 18000, 45000],
            ['peralatan-minum', 'Botol Cold Brew 750ml', 'Botol kaca cold brew isi 750ml.', 0, 35000, 75000],
            ['peralatan', 'Teko Pour Over 1,2L', 'Teko gooseneck pour over 1,2 liter.', 8, 65000, 120000],
            ['peralatan', 'French Press 600ml', 'French press kaca tahan panas 600ml.', 5, 55000, 105000],
            ['peralatan', 'Timbangan Digital 0,1g', 'Timbangan digital akurasi 0,1 gram.', 64, 90000, 160000],
            ['aksesori', 'Filter Paper V60', 'Kertas filter V60 box isi 100 pcs.', 12, 15000, 28000],
            ['aksesori', 'Pitcher Latte 600ml', 'Pitcher stainless untuk latte art.', 33, 40000, 78000],
        ];

        foreach ($produk as [$kategori, $nama, $deskripsi, $stok, $hargaBeli, $hargaJual]) {
            $kategoriId = $bySlug[$kategori] ?? null;

            $kat = $kategoriId ? Kategori::find($kategoriId) : null;

            Produk::updateOrCreate(
                ['nama' => $nama],
                [
                    'sku' => $kat ? $kat->nextSku() : 'SKU-'.str_pad((string) rand(1000, 9999), 4, '0', STR_PAD_LEFT),
                    'deskripsi' => $deskripsi,
                    'kategori_id' => $kategoriId,
                    'stok' => $stok,
                    'harga_beli' => $hargaBeli,
                    'harga_jual' => $hargaJual,
                    'stok_minimal' => 10,
                ]
            );
        }
    }
}