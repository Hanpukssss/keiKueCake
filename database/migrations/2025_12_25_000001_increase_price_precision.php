<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * Ubah kolom harga/total_price agar bisa menampung nilai besar dari transaksi publik.
     */
    public function up(): void
    {
        // Tambah kolom sementara dengan presisi lebih besar
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price_tmp', 15, 2)->default(0);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('total_price_tmp', 18, 2)->default(0);
        });

        // Salin data lama ke kolom baru
        DB::table('products')->update(['price_tmp' => DB::raw('price')]);
        DB::table('transactions')->update(['total_price_tmp' => DB::raw('total_price')]);

        // Hapus kolom lama dan ganti nama kolom baru
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('price_tmp', 'price');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('total_price_tmp', 'total_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke decimal default yang lebih kecil (10,2) untuk berjaga jika rollback
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price_tmp', 10, 2)->default(0);
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('total_price_tmp', 10, 2)->default(0);
        });

        DB::table('products')->update(['price_tmp' => DB::raw('price')]);
        DB::table('transactions')->update(['total_price_tmp' => DB::raw('total_price')]);

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('price_tmp', 'price');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('total_price_tmp', 'total_price');
        });
    }
};
