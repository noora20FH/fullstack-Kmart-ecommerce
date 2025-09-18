<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_categories')->insert([
            ['name' => 'Album'],
            ['name' => 'Lightstick'],
            ['name' => 'Pakaian'],
            ['name' => 'Aksesoris'],
        ]);
    }
}
