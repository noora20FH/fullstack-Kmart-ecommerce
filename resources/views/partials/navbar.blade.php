<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" style="color: #fff; font-weight: bold;">
            <img src="{{asset('image/logo.png')}}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(
                (Auth::check() && (Auth::user()->role === 'customer')) ||
                (!Auth::check())
                )
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">Produk</a>
                </li>

                <li class="nav-item">
                    <!-- Untuk link anchor, kita cek URL. -->
                    <a class="nav-link {{ Request::is('/') && request()->url() . '#faq-section' == url('/#faq-section') ? 'active' : '' }}" href="{{ url('/#faq-section') }}">FAQ</a>
                </li>
                <li class="nav-item">
                    <!-- Untuk link anchor, kita cek URL. -->
                    <a class="nav-link {{ Request::is('/') && request()->url() . '#about-us' == url('/#about-us') ? 'active' : '' }}" href="{{ url('/#about-us') }}">Tentang Kami</a>
                </li>
                <li>
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('checkout.index') }}">Checkout</a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin-products.index') ? 'active' : '' }}" href="{{ route('admin-products.index') }}">Product List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('product-category.index') ? 'active' : '' }}" href="{{ route('product-category.index') }}">Product Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">Status Order</a>
                </li>
                @endif
            </ul>
            @auth
            <div class="d-flex gap-2">
                @if(Auth::user()->role === 'customer')
                <a href="{{ route('cart.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-cart"></i>
                </a>
                @endif
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end p-2">
                        <!-- Informasi Profil Dinamis -->
                        <li class="profile-info d-flex align-items-center mb-2 px-3">
                            @php
                            $extensions = ['png', 'jpg', 'jpeg', 'webp'];
                            $photoFound = false;
                            @endphp

                            @foreach($extensions as $ext)
                            @if(file_exists(public_path('storage/profiles/' . Auth::user()->id . '.' . $ext)))
                            <img src="{{ asset('storage/profiles/' . Auth::user()->id . '.' . $ext) }}" alt="Profile Photo" class="profile-photo rounded-circle me-2">
                            @php $photoFound = true; break; @endphp
                            @endif
                            @endforeach

                            @if(!$photoFound)
                            {{-- Tampilkan gambar default jika tidak ada yang ditemukan --}}
                            <img src="{{ asset('image/logo.png') }}" alt="Default Profile Photo" class="profile-photo rounded-circle me-2" style="width: 40px">
                            @endif
                            <div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <p class="text-muted mb-0" style="font-size: 0.875em;">{{ Auth::user()->email }}</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Tautan -->
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit', ['profile' => Auth::user()->id]) }}">
                                <i class="bi bi-person me-2"></i>Edit Profile
                            </a>
                        </li>
                        @if(Auth::user()->role === 'customer')
                        <li><a class="dropdown-item" href="{{route('orders.index')}}"><i class="bi bi-box-seam me-2"></i>Riwayat Pesanan</a></li>
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Tautan Logout -->
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item text-danger" href="{{ route('home') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="bi bi-box-arrow-right text-danger me-2"></i>Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endauth

            <!-- Bagian ini akan muncul HANYA jika pengguna BELUM login -->
            @guest
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-light mx-1">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-light mx-1">Daftar</a>
            </div>
            @endguest


        </div>
    </div>
</nav>