<footer class="footer py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-3">
                <img src="{{ asset('image/logo.png') }}" alt="" class="img-fluid w-50 items-center text-center">
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <h5>K-Pop Mart</h5>
                <p class="text-white-50">Toko online terpercaya untuk semua kebutuhan merchandise K-Pop resmi. Dapatkan koleksi terbaik dari idola favoritmu.</p>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <h5>Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-white text-decoration-none">Produk</a></li>
                    <li><a href="{{ url('/#faq-section') }}" class="text-white text-decoration-none">FAQ</a></li>
                    <li><a href="{{ url('/#about-us') }}" class="text-white text-decoration-none">Tentang Kami</a></li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <h5>Ikuti Kami</h5>
                <a href="https://www.facebook.com/" class="text-white me-2 fs-4" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/" class="text-white me-2 fs-4" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="https://x.com/?lang=en-id" class="text-white fs-4" target="_blank"><i class="bi bi-twitter"></i></a>
            </div>
        </div>
        <hr class="text-white-50">
        <div class="text-center text-white-50">
            &copy; 2025 K-Pop Mart. All Rights Reserved.
        </div>
    </div>
</footer>