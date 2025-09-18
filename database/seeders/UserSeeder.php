<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     */
    public function run(): void
    {
        // ⚠️ Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Menghapus pengguna yang sudah ada untuk menghindari duplikasi
        User::truncate();

        // ⚠️ Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Membuat 2 pengguna dengan status 'customer'
        User::create([
            'name' => 'Customer Satu',
            'email' => 'customer1@example.com',
            'password' => Hash::make('password'),
            'photo_profile' => null,
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Customer Dua',
            'email' => 'customer2@example.com',
            'password' => Hash::make('password'),
            'photo_profile' => null,
            'role' => 'customer',
        ]);

        // Membuat 1 pengguna dengan status 'admin'
        User::create([
            'name' => 'Admin Satu',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password'),
            'photo_profile' => null,
            'role' => 'admin',
        ]);
    }
}