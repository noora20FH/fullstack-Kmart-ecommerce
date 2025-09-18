<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Kolom-kolom baru untuk menyimpan informasi pengiriman
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('shipping_address');
            
            // Kolom-kolom baru untuk detail ringkasan pesanan
            $table->decimal('subtotal_amount', 10, 2);
            $table->decimal('shipping_fee', 10, 2);
            $table->string('payment_method');

            // Kolom 'total_amount' diubah menjadi `total_payment` agar lebih jelas
            $table->decimal('total_payment', 10, 2);
            
            // Status pesanan
            $table->string('status')->default('pending'); // pending, completed, shipped, canceled
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
