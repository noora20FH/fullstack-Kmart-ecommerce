<x-auth-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-100 p-md-4 p-3" style="max-width: 450px;">
        <div class="mb-3 text-end">
            <a href="{{ route('register') }}" class="text-decoration-none text-muted">Register</a>
        </div>
        <h3 class="mb-3 text-center fw-semibold">Login</h3>
        <p class="text-center text-muted mb-4">Fill the form below to login</p>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com" />
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="password" />
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me dan Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="text-decoration-underline text-muted" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    {{ __('Log in') }}
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
</x-auth-layout>
