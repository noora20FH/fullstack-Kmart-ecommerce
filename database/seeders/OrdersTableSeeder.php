<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Temukan atau buat pengguna baru agar tidak ada duplikat email
        $user = User::firstOrCreate(
            ['email' => 'customer1@example.com'], // Kriteria pencarian
            [
                'name' => 'Customer Satu',
                'password' => bcrypt('password'),
            ]
        );

        // Pastikan ada beberapa produk di database
        // Ambil kategori berdasarkan nama, sesuai dengan isi tabel product_categories
        $categoryAlbum = \App\Models\ProductCategory::where('name', 'Album')->first();
        $categoryLightstick = \App\Models\ProductCategory::where('name', 'Lightstick')->first();
        $categoryPakaian = \App\Models\ProductCategory::where('name', 'Pakaian')->first();
        $categoryAksesoris = \App\Models\ProductCategory::where('name', 'Aksesoris')->first();

        $product1 = Product::firstOrCreate(['name' => "Hoodie 'Seventeen'"], [
            'group' => "Seventeen",
            'category_id' => $categoryPakaian ? $categoryPakaian->id : null,
            'price' => 490000.00,
            'stock' => 35,
            'image' => "https://via.placeholder.com/400x400/9370DB/FFFFFF?text=Hoodie+Seventeen",
            'description' => "Hoodie official untuk penggemar Seventeen.",
            'isNew' => false,
        ]);

        $product2 = Product::firstOrCreate(['name' => "Album 'Glitch Mode'"], [
            'group' => "NCT Dream",
            'category_id' => $categoryAlbum ? $categoryAlbum->id : null,
            'price' => 315000.00,
            'stock' => 55,
            'image' => "https://via.placeholder.com/400x400/6A5ACD/FFFFFF?text=Album+NCT+Dream",
            'description' => "Album studio kedua dari NCT Dream.",
            'isNew' => true,
        ]);
        
        $product3 = Product::firstOrCreate(['name' => "Lightstick 'Eri-bong'"], [
            'group' => "EXO",
            'category_id' => $categoryLightstick ? $categoryLightstick->id : null,
            'price' => 610000.00,
            'stock' => 18,
            'image' => "https://via.placeholder.com/400x400/BDB76B/FFFFFF?text=Lightstick+EXO",
            'description' => "Lightstick resmi untuk penggemar EXO.",
            'isNew' => false,
        ]);

        // Hitung total_amount dan subtotal_amount secara dinamis
        $shippingFee = 25000.00;
        $orderSubtotal = ($product1->price * 1) + ($product2->price * 1) + ($product3->price * 2);
        $orderTotal = $orderSubtotal + $shippingFee;

        // Buat satu pesanan (order)
        $order = Order::create([
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'customer_phone' => '08123456789',
            'shipping_address' => 'Jl. Sudirman No. 123, RT 01/RW 02, Kota Surabaya, Jawa Timur, 60234',
            'subtotal_amount' => $orderSubtotal,
            'shipping_fee' => $shippingFee,
            'payment_method' => 'E-wallet',
            'total_payment' => $orderTotal,
            'status' => 'completed',
        ]);

        // Tambahkan item-item pesanan (order_items) ke dalam pesanan yang baru dibuat
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product1->id,
            'quantity' => 1,
            'price' => $product1->price,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product2->id,
            'quantity' => 1,
            'price' => $product2->price,
        ]);
        
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product3->id,
            'quantity' => 2,
            'price' => $product3->price,
        ]);
    }
}
