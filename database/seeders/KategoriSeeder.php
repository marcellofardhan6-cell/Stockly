<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Kopi', 'category_code' => 'KOP', 'deskripsi' => 'Biji kopi, bubuk, dan produk kopi.'],
            ['nama' => 'Peralatan Minum', 'category_code' => 'PRM', 'deskripsi' => 'Mug, botol, dan gelas.'],
            ['nama' => 'Peralatan', 'category_code' => 'PRL', 'deskripsi' => 'Teko, timbangan, dan alat seduh.'],
            ['nama' => 'Aksesori', 'category_code' => 'AKS', 'deskripsi' => 'Filter, paper, dan aksesori pendukung.'],
        ];

        foreach ($kategori as $item) {
            Kategori::updateOrCreate(
                ['slug' => Str::slug($item['nama'])],
                $item
            );
        }
    }
}
