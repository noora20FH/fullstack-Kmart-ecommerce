<x-authlayout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    
    <!-- Bagian Komponen Register yang baru ditambahkan -->
    <div class="w-100 p-md-4 p-3" style="max-width: 450px;">
        <div class="mb-3 text-end">
            <a href="{{ route('login') }}" class="text-decoration-none text-muted">Login</a>
        </div>
        <h3 class="mb-3 text-center fw-semibold">Register</h3>
        <p class="text-center text-muted mb-4">Create your account to get started</p>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Full Name" />
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="name@example.com" />
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="password" />
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="confirm password" />
                @error('password_confirmation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
        
        <div class="d-flex align-items-center text-center text-muted my-4">
            <span class="flex-grow-1 border-bottom border-secondary-subtle"></span>
            <span class="mx-2">OR CONTINUE WITH</span>
            <span class="flex-grow-1 border-bottom border-secondary-subtle"></span>
        </div>
        
        <div class="d-grid">
            <button class="btn btn-light btn-lg border d-flex justify-content-center align-items-center fw-medium">
                <img src="https://www.google.com/favicon.ico" alt="Google icon" class="me-2" style="width: 20px; height: 20px;">
                Google
            </button>
        </div>

        <div class="mt-4 text-center text-secondary" style="font-size: 0.8rem;">
            By clicking continue, you agree to our 
            <a href="#" class="text-decoration-none text-muted">Terms of Service</a> 
            and 
            <a href="#" class="text-decoration-none text-muted">Privacy Policy</a>.
        </div>
    </div>
</x-authlayout>
