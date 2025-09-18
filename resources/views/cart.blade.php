<x-mainlayout title="K-Pop Mart Keranjang Belanja">
    <main class="container my-5">
        <x-breadcrumb :items="[
            ['label' => 'Produk', 'url' => route('products.index')],
            ['label' => 'Keranjang', 'url' => route('cart.index')],
        ]" />

        <h1 class="mb-4">Keranjang Belanja</h1>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm p-3">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col" class="text-center">Harga</th>
                                    <th scope="col" class="text-center">Jumlah</th>
                                    <th scope="col" class="text-end">Total</th>
                                    <th scope="col" class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartItems as $item)
                                <tr data-item-price="{{ $item->product->price }}" data-item-id="{{ $item->id }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/image/' . $item->product->image) }}" class="cart-item-img rounded me-3" width="150px" alt="{{ $item->product->name }}">
                                            <div>
                                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                <small class="text-muted">{{ Str::limit($item->product->description, 30) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        {{$item->quantity}}
                                    </td>
                                    <td class="text-end fw-bold item-total">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                    <td class="text-end d-flex gap-2 justify-content-end">
                                        <!-- Tombol Checkout Per Item -->
                                        <form action="{{ route('checkout.singleItem', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Checkout</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editQuantityModal-{{ $item->id }}">Edit</button>

                                        <!-- Modal Edit Quantity -->
                                        <div class="modal fade" id="editQuantityModal-{{ $item->id }}" tabindex="-1" aria-labelledby="editQuantityModalLabel-{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editQuantityModalLabel-{{ $item->id }}">Edit Jumlah Produk</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('cart.update') }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="quantity-{{ $item->id }}" class="form-label">Jumlah untuk <strong>{{ $item->product->name }}</strong>:</label>
                                                                <input type="number" class="form-control" id="quantity-{{ $item->id }}" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="0">
                                                            </div>
                                                            <p class="text-danger small mt-2">Item dengan kuantitas 0 akan dihapus dari keranjang.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Keranjang Anda kosong.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Ringkasan Pesanan Dihapus -->
        </div>
    </main>
</x-mainlayout>
