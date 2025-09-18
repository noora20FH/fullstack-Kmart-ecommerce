<x-mainlayout title="K-Pop Mart">

<x-statusInfo />

    <main class="container my-5">
        <h1 class="mb-4">Daftar Produk</h1>
        <a href="{{ route('admin-products.create') }}" class="btn btn-primary mb-3">Tambah Produk Baru</a>

        {{-- Tabel Responsif --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Grup</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->group }}</td>
                            <td>{{ $product->category->name }}</td> {{-- Mengakses nama kategori melalui relationship --}}
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <img src="{{ asset('storage/image/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 150px;">
                            </td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td class="d-flex gap-2">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin-products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                {{-- Form dan Tombol Delete --}}
                                <form action="{{ route('admin-products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada produk yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tautan Paginasi --}}
        <div class="justify-content-between align-items-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
        


    </main>

</x-mainlayout>