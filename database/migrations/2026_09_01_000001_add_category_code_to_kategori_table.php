<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->string('category_code', 5)->unique()->nullable()->after('nama');
        });

        $codes = [
            1 => 'KOP',
            2 => 'PRM',
            3 => 'PRL',
            4 => 'AKS',
        ];

        foreach ($codes as $id => $code) {
            DB::table('kategori')->where('id', $id)->update(['category_code' => $code]);
        }

        $this->regenerateProductSkus();
    }

    public function down(): void
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropUnique(['category_code']);
            $table->dropColumn('category_code');
        });
    }

    private function regenerateProductSkus(): void
    {
        $kategoris = DB::table('kategori')
            ->whereNotNull('category_code')
            ->orderBy('id')
            ->get();

        foreach ($kategoris as $kategori) {
            $kode = strtoupper($kategori->category_code);
            $prefix = $kode.'-';
            $urutan = 1;

            $products = DB::table('produk')
                ->where('kategori_id', $kategori->id)
                ->orderBy('id')
                ->get();

            foreach ($products as $product) {
                DB::table('produk')
                    ->where('id', $product->id)
                    ->update([
                        'sku' => $prefix.str_pad((string) $urutan, 4, '0', STR_PAD_LEFT),
                    ]);
                $urutan++;
            }
        }
    }
};
