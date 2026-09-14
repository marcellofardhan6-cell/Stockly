<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->string('metode_bayar')->default('tunai')->after('total');
            $table->unsignedBigInteger('uang_diterima')->default(0)->after('metode_bayar');
            $table->unsignedBigInteger('kembalian')->default(0)->after('uang_diterima');
            $table->unsignedBigInteger('diskon')->default(0)->after('kembalian');
            $table->unsignedBigInteger('subtotal')->default(0)->after('diskon');
        });
    }

    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn(['metode_bayar', 'uang_diterima', 'kembalian', 'diskon', 'subtotal']);
        });
    }
};