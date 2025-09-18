<section>
    <header>
        <p class="mt-2 text-muted">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Perbaikan: Tambahkan enctype --}}
    <form method="post" action="{{ route('profile.update',$user->id) }}" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <x-input-label for="name" :value="__('Nama')" class="form-label" />
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" class="form-label" />
            <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-dark">
                    {{ __('Alamat email Anda belum terverifikasi.') }}

                    <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-underline">
                        {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success mt-2 p-2" role="alert">
                    {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email Anda.') }}
                </div>
                @endif
            </div>
            @endif
        </div>
        <div class="mb-3">
            <x-input-label for="phone" :value="__('Phone')" class="form-label" />
            <input id="phone" name="phone" type="tel" class="form-control" value="{{ old('phone', $user->phone) }}" required>
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        <div class="mb-3">
            <x-input-label for="address" :value="__('Alamat')" class="form-label" />
            <textarea id="address" name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="mb-3">
            <x-input-label for="photo_profile" :value="__('Foto Profil')" class="form-label" />
            <input type="file" id="photo_profile" name="photo_profile" class="form-control" />
            <x-input-error class="mt-2" :messages="$errors->get('photo_profile')" />
            @if($user->photo_profile)
            <div class="mt-2">
                {{-- Perbaikan: Perbaiki jalur gambar --}}
                <img src="{{ asset('storage/' . $user->photo_profile) }}" alt="Foto Profil" class="img-thumbnail" style="max-width: 150px;">
            </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>

            @if (session('status') === 'profile-updated')
            <div class="alert alert-success p-2 mb-0" role="alert"
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)">
                {{ __('Tersimpan.') }}
            </div>
            @endif
        </div>
    </form>
</section>