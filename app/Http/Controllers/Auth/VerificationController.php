<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // 1. Cek User Exist dan Token Cocok
        // Gunakan logic yang lebih ketat jika token disimpan di hash
        if ($user->verification_token !== $hash) {
            return redirect('/login')->withErrors(['error' => 'Link verifikasi tidak valid atau telah kedaluwarsa.']);
        }
        
        // 2. Cek apakah link ditandatangani dengan benar (Middleware 'signed' yang akan melakukan ini)
        if (! URL::hasValidSignature($request)) {
             return redirect('/login')->withErrors(['error' => 'Link verifikasi tidak valid atau telah kedaluwarsa.']);
        }

        // 3. Cek apakah user sudah terverifikasi
        if ($user->email_verified_at) {
            return redirect('/home')->with('status', 'Akun Anda sudah terverifikasi. Silakan masuk.');
        }

        // 4. Verifikasi Berhasil
        $user->email_verified_at = Carbon::now();
        $user->verification_token = null; // Hapus token setelah verifikasi
        $user->save();
        // 5. Otomatis login user setelah verifikasi
        Auth::login($user);

        return redirect('/home')->with('status', 'Email Anda berhasil diverifikasi! Selamat datang di Kpop Mart.');
    }
}