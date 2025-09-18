<x-mainlayout title="K-Pop Mart Checkout">

    <main class="container my-5">
        @php
        $items = [
        ['label' => 'Produk', 'url' => route('products.index')],
        ['label' => 'Cart', 'url' => route('cart.index')],
        ['label' => 'Checkout', 'url' => '#'],
        ];
        @endphp

        <x-breadcrumb :items="$items" />
        <h1 class="mb-4">Checkout</h1>

        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Informasi Pengiriman -->
                <div class="card shadow-sm p-4 mb-4">
                    <h5 class="mb-4">Informasi Pengiriman</h5>
                    <div class="mb-3">
                        <p class="mb-1"><strong>Nama Lengkap:</strong> {{ $checkout->user->name ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Nomor HP:</strong> {{ $checkout->user->phone ?? 'N/A' }}</p>
                        <p class="mb-0"><strong>Alamat Pengiriman:</strong> {{ $checkout->user->address ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Cari Tujuan Pengiriman -->
                <!-- <div class="card shadow-sm p-4 mb-4">
                    @livewire('princing-check')

                </div> -->

                <!-- Detail Pesanan -->
                <div class="card shadow-sm p-4 mb-4">
                    <h5 class="mb-4">Detail Pesanan</h5>
                    <div class="list-group list-group-flush">
                        @if ($checkout && $checkout->checkoutItems)
                        @forelse ($checkout->checkoutItems as $item)
                        <div class="list-group-item card-product-detail d-flex align-items-center justify-content-between py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/image/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="me-3" width="80px" height="80px">
                                <div>
                                    <h6 class="mb-0">{{ $item->product->name }}</h6>
                                    <small class="text-muted">Harga satuan: Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="me-4 text-muted">{{ $item->quantity }}x</span>
                                <span class="fw-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="list-group-item">
                            Tidak ada item dalam pesanan ini.
                        </div>
                        @endforelse
                        @else
                        <div class="list-group-item">
                            Data pesanan tidak ditemukan.
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <!-- <div class="card shadow-sm p-4">
                    <h5 class="mb-4">Pilih Metode Pembayaran</h5>
                    <div class="my-3">
                        <div class="form-check mb-2">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                            <label class="form-check-label" for="credit">
                                <i class="fas fa-credit-card me-2"></i> Kartu Kredit / Debit
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input id="bank" name="paymentMethod" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="bank">
                                <i class="fas fa-university me-2"></i> Bank Transfer
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="ewallet" name="paymentMethod" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="ewallet">
                                <i class="fas fa-wallet me-2"></i> E-wallet (DANA, OVO, GoPay)
                            </label>
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="col-lg-4">
                <div class="card shadow-sm p-4 sticky-top" style="top: 2rem;">
                    <h5 class="mb-3">Ringkasan Pesanan</h5>
                    <ul class="list-group list-group-flush card-order-summary">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Subtotal Produk</strong>
                            <span>Rp {{ number_format($summary->subtotal ?? 0, 0, ',', '.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Total Pengiriman</strong>
                            <span>Rp {{ number_format($summary->shipping_cost ?? 0, 0, ',', '.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Pajak (10%)</strong>
                            <span>Rp {{ number_format($summary->tax_amount ?? 0, 0, ',', '.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between fw-bold fs-5">
                            <strong>Total Pesanan</strong>
                            <span class="text-kpop-accent">Rp {{ number_format($summary->total_amount ?? 0, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                    <hr class="my-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('checkout.process')}}" class="btn btn-kpop btn-lg" type="button">Buat Pesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-mainlayout>