<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('checkout_items', function (Blueprint $table) {
            // Hapus kolom 'checkout_id'
            $table->dropForeign(['checkout_id']);
            $table->dropColumn('checkout_id');

            // Tambahkan kolom 'user_id'
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Tambahkan kolom 'subtotal'
            $table->decimal('subtotal', 10, 2)->after('quantity');
        });
    }

    /**
     * Batalkan migrasi (rollback).
     */
    public function down(): void
    {
        Schema::table('checkout_items', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('subtotal');

            // Tambahkan kembali kolom yang dihapus (untuk rollback)
            $table->unsignedBigInteger('checkout_id')->after('id');
            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade');
        });
    }
};