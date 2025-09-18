<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => "Album 'Don't Wanna Cry'",
                'group' => "Seventeen",
                'category_id' => 1,
                'price' => 350000,
                'stock' => 50,
                'image' => "public/image/album.jpg",
                'description' => "Album lengkap dengan photocard dan poster.",
                'isNew' => true
            ],
            [
                'name' => "Lightstick 'Carat Bong'",
                'group' => "Seventeen",
                'category_id' => 2,
                'price' => 600000,
                'stock' => 20,
                'image' => "https://via.placeholder.com/400x400/87CEEB/FFFFFF?text=Lightstick+Seventeen",
                'description' => "Lightstick official untuk konser.",
                'isNew' => false
            ],
            [
                'name' => "Album 'S-Class'",
                'group' => "Straykids",
                'category_id' => 1,
                'price' => 380000,
                'stock' => 45,
                'image' => "https://via.placeholder.com/400x400/FFB6C1/FFFFFF?text=Album+Straykids",
                'description' => "Album terbaru dengan photocard eksklusif.",
                'isNew' => true
            ],
            [
                'name' => "Hoodie 'Blackpink'",
                'group' => "Blackpink",
                'category_id' => 3,
                'price' => 475000,
                'stock' => 30,
                'image' => "https://via.placeholder.com/400x400/DA70D6/FFFFFF?text=Hoodie+Blackpink",
                'description' => "Hoodie official untuk penggemar Blackpink.",
                'isNew' => false
            ],
            [
                'name' => "Album 'Overload'",
                'group' => "X-Heroes",
                'category_id' => 1,
                'price' => 250000,
                'stock' => 60,
                'image' => "https://via.placeholder.com/400x400/9370DB/FFFFFF?text=Album+X-Heroes",
                'description' => "Mini album pertama dari Xdinary Heroes.",
                'isNew' => true
            ],
            [
                'name' => "Kaos 'NCTzen'",
                'group' => "NCT",
                'category_id' => 3,
                'price' => 180000,
                'stock' => 75,
                'image' => "https://via.placeholder.com/400x400/87CEEB/FFFFFF?text=Kaos+NCT",
                'description' => "Kaos fanmade dengan logo NCTzen.",
                'isNew' => false
            ],
            [
                'name' => "Album 'Odd Eye'",
                'group' => "Shinee",
                'category_id' => 1,
                'price' => 300000,
                'stock' => 40,
                'image' => "https://via.placeholder.com/400x400/FFB6C1/FFFFFF?text=Album+Shinee",
                'description' => "Album comeback Shinee.",
                'isNew' => true
            ],
            [
                'name' => "Photocard 'EXO'",
                'group' => "EXO",
                'category_id' => 4,
                'price' => 120000,
                'stock' => 100,
                'image' => "https://via.placeholder.com/400x400/DA70D6/FFFFFF?text=Photocard+EXO",
                'description' => "Set photocard edisi terbatas.",
                'isNew' => false
            ],
            [
                'name' => "Lightstick 'Lightstick Pink'",
                'group' => "Blackpink",
                'category_id' => 2,
                'price' => 750000,
                'stock' => 15,
                'image' => "https://via.placeholder.com/400x400/FF69B4/FFFFFF?text=Lightstick+BP",
                'description' => "Lightstick official untuk Blinks.",
                'isNew' => false
            ],
            [
                'name' => "Tote Bag 'Straykids'",
                'group' => "Straykids",
                'category_id' => 3,
                'price' => 150000,
                'stock' => 80,
                'image' => "https://via.placeholder.com/400x400/808080/FFFFFF?text=Tote+Bag+SKZ",
                'description' => "Tote bag official Straykids.",
                'isNew' => true
            ],
            [
                'name' => "Keychain 'EXO'",
                'group' => "EXO",
                'category_id' => 4,
                'price' => 85000,
                'stock' => 90,
                'image' => "https://via.placeholder.com/400x400/4169E1/FFFFFF?text=Keychain+EXO",
                'description' => "Gantungan kunci official EXO.",
                'isNew' => false
            ],
            [
                'name' => "T-Shirt 'Blackpink in Your Area'",
                'group' => "Blackpink",
                'category_id' => 3,
                'price' => 250000.00,
                'stock' => 65,
                'image' => "https://via.placeholder.com/400x400/BDB76B/FFFFFF?text=T-Shirt+Blackpink",
                'description' => "T-shirt official dari tur Blackpink.",
                'isNew' => true
            ],
            [
                'name' => "Hoodie 'EXO Planet'",
                'group' => "EXO",
                'category_id' => 3,
                'price' => 480000.00,
                'stock' => 25,
                'image' => "https://via.placeholder.com/400x400/4682B4/FFFFFF?text=Hoodie+EXO",
                'description' => "Hoodie official dari tur konser EXO.",
                'isNew' => false
            ],
            [
                'name' => "Photocard 'NCT Dream'",
                'group' => "NCT Dream",
                'category_id' => 4,
                'price' => 130000.00,
                'stock' => 120,
                'image' => "https://via.placeholder.com/400x400/90EE90/FFFFFF?text=Photocard+NCT+Dream",
                'description' => "Set photocard edisi khusus dari NCT Dream.",
                'isNew' => false
            ],
            [
                'name' => "Hoodie 'Seventeen'",
                'group' => "Seventeen",
                'category_id' => 3,
                'price' => 490000.00,
                'stock' => 35,
                'image' => "https://via.placeholder.com/400x400/9370DB/FFFFFF?text=Hoodie+Seventeen",
                'description' => "Hoodie official untuk penggemar Seventeen.",
                'isNew' => false
            ],
            [
                'name' => "Album 'Glitch Mode'",
                'group' => "NCT Dream",
                'category_id' => 1,
                'price' => 315000.00,
                'stock' => 55,
                'image' => "https://via.placeholder.com/400x400/6A5ACD/FFFFFF?text=Album+NCT+Dream",
                'description' => "Album studio kedua dari NCT Dream.",
                'isNew' => true
            ],
            [
                'name' => "Lightstick 'Eri-bong'",
                'group' => "EXO",
                'category_id' => 2,
                'price' => 610000.00,
                'stock' => 18,
                'image' => "https://via.placeholder.com/400x400/BDB76B/FFFFFF?text=Lightstick+EXO",
                'description' => "Lightstick resmi untuk penggemar EXO.",
                'isNew' => false
            ],
            [
                'name' => "T-Shirt 'Stray Kids'",
                'group' => "Stray Kids",
                'category_id' => 3,
                'price' => 210000.00,
                'stock' => 70,
                'image' => "https://via.placeholder.com/400x400/808080/FFFFFF?text=T-Shirt+Stray+Kids",
                'description' => "T-shirt official dari Stray Kids.",
                'isNew' => true
            ],
            [
                'name' => "Keyring 'Blackpink'",
                'group' => "Blackpink",
                'category_id' => 4,
                'price' => 95000.00,
                'stock' => 95,
                'image' => "https://via.placeholder.com/400x400/FF69B4/FFFFFF?text=Keyring+Blackpink",
                'description' => "Gantungan kunci official Blackpink.",
                'isNew' => false
            ],
            [
                'name' => "Album 'NCT 2020 Resonance Pt. 1'",
                'group' => "NCT",
                'category_id' => 1,
                'price' => 360000,
                'stock' => 48,
                'image' => "https://via.placeholder.com/400x400/3CB371/FFFFFF?text=Album+NCT",
                'description' => "Album studio kedua dari NCT.",
                'isNew' => false
            ]
        ];
                // Memasukkan data ke database menggunakan model
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
