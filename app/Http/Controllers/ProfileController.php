<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mendapatkan data yang divalidasi dari request
        $validatedData = $request->validated();
        
        // Menangani unggahan foto profil
        if ($request->hasFile('photo_profile')) {
            // Hapus foto profil lama jika ada
            if ($request->user()->photo_profile) {
                Storage::disk('public')->delete($request->user()->photo_profile);
            }
            
            // Simpan foto baru ke dalam folder 'profiles' di public disk
            $path = $request->file('photo_profile')->store('profiles', 'public');
            $validatedData['photo_profile'] = $path;
        }

        $user = $request->user();
        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit', ['profile' => $user])->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
