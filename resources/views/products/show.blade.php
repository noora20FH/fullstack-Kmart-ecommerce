<x-mainlayout title="K-Pop Mart Produk details">

    <main class="container my-5">
        <x-breadcrumb :items="[
    ['label' => 'Home', 'url' => url('/')],
    ['label' => 'Produk', 'url' => route('products.index')],
    ['label' => $product->name, 'url' => '#'],
]" />

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card p-3">
                    <img id="mainProductImage" src="{{ asset('storage/image/' . $product->image) }}" class="img-fluid product-image-main rounded" alt="{{ $product->name }}">
                    <div class="d-flex flex-row mt-3 justify-content-center">
                        @if($product->image)
                        <img src="{{ asset('storage/image/' . $product->image) }}" class="product-thumbnail me-2 rounded active" alt="{{ $product->name }}" onclick="document.getElementById('mainProductImage').src=this.src">
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <h1>{{ $product->name }}</h1>
                <p class="lead text-muted">{{ Str::limit($product->description, 100) }}</p>
                <h2 class="text-kpop-accent fw-bold my-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>

                <p>{{ $product->description }}</p>

                {{-- FORMULIR INI AKAN MENGIRIM DATA PRODUK KE KERANJANG --}}
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    {{-- Input tersembunyi untuk ID produk --}}
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-kpop btn-lg" {{ $product->stock === 0 ? 'disabled' : '' }}>
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </form>

                <!-- {{-- Tautan "Beli Sekarang" tetap menggunakan <a> jika diarahkan ke halaman checkout --}}
                <div class="d-grid gap-2 mt-2">
                     <a href="{{route('cart.store')}}" class="btn btn-outline-dark btn-lg">
                        Beli Sekarang
                    </a>
                </div> -->

                <hr class="my-4">

                <p><strong>Kategori:</strong> Album, Merchandise</p>
                <p><strong>Stok:</strong> <span class="text-{{ $product->stock > 0 ? 'success' : 'danger' }} fw-bold">{{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}</span></p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="deskripsi-tab" data-bs-toggle="tab" data-bs-target="#deskripsi" type="button" role="tab" aria-controls="deskripsi" aria-selected="true">Deskripsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="spesifikasi-tab" data-bs-toggle="tab" data-bs-target="#spesifikasi" type="button" role="tab" aria-controls="spesifikasi" aria-selected="false">Spesifikasi</button>
                    </li>
                </ul>
                <div class="tab-content border border-top-0 p-3" id="productTabsContent">
                    <div class="tab-pane fade show active" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="tab-pane fade" id="spesifikasi" role="tabpanel" aria-labelledby="spesifikasi-tab">
                        <p><strong>Nama Produk:</strong> {{ $product->name }}</p>
                        <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p><strong>Stok:</strong> {{ $product->stock }}</p>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        const thumbnails = document.querySelectorAll('.product-thumbnail');
        const mainImage = document.getElementById('mainProductImage');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', () => {
                thumbnails.forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
                mainImage.src = thumb.src;
            });
        });
    </script>
</x-mainlayout>