<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL; // <-- WAJIB: Tambahkan Facade URL
use Carbon\Carbon;                   // <-- WAJIB: Tambahkan Carbon
use App\Mail\RegistrationConfirmation;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // HILANGKAN: $token = Str::random(60);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // HILANGKAN: 'verification_token' => $token, // Tidak perlu jika pakai signed route
        ]);

        // 1. Buat Signed URL Verifikasi (LEBIH AMAN)
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60), // Link berlaku selama 60 menit
            [
                'id' => $user->id,
                // WAJIB: Tambahkan parameter 'hash' dengan nilai SHA1 dari email
                'hash' => sha1($user->email),
            ]
        );

        // 2. Kirim Email Konfirmasi
        try {
            // Perhatikan Mailable Anda harus menerima $verificationUrl sebagai parameter
            Mail::to($user->email)->send(new RegistrationConfirmation($verificationUrl, $user->name));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email konfirmasi via Brevo: ' . $e->getMessage());
            // Penanganan error pengiriman email
        }

        event(new Registered($user));

        return redirect(route('login'))
            ->with('status', 'Pendaftaran berhasil! Silakan cek email Anda untuk mengaktifkan akun.');
    }
}
