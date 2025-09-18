<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Menampilkan formulir untuk membuat pengguna baru.
     */
    public function create()
    {
        // Logika untuk menampilkan halaman formulir
        return view('users.create');
    }

    /**
     * Menyimpan pengguna yang baru dibuat di penyimpanan.
     */
    public function store(Request $request)
    {
        try {
            // Validasi data input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role' => 'required|in:customer,admin', // Validasi status
            ]);

            $photoPath = null;
            if ($request->hasFile('photo_profile')) {
                // Simpan foto profil di direktori 'public/profiles'
                $photoPath = $request->file('photo_profile')->store('profiles', 'public');
            }

            // Buat pengguna baru dengan data yang divalidasi
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'photo_profile' => $photoPath,
                'status' => $validatedData['status'], // Menyimpan status
            ]);

            // Redirect ke halaman lain setelah berhasil
            return redirect()->route('home')->with('success', 'User berhasil dibuat!');

        } catch (ValidationException $e) {
            // Tangani error validasi dan kembali ke halaman sebelumnya
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
