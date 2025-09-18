<x-mainlayout title="K-Pop Mart">

    <main class="container my-5">
        <h1 class="mb-4">Kategori Produk</h1>
        {{-- Tombol untuk membuka Modal Tambah --}}
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            Tambah Kategori
        </button>

        {{-- Tabel Responsif --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Jumlah Produk</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>Rp {{ number_format($category->products_sum_price, 0, ',', '.') }}</td>
                        <td class="d-flex gap-2">
                            {{-- Tombol Edit yang memicu modal --}}
                            <button type="button" class="btn btn-sm btn-warning edit-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editCategoryModal"
                                data-category-id="{{ $category->id }}"
                                data-category-name="{{ $category->name }}">
                                Edit
                            </button>

                            {{-- Form dan Tombol Delete --}}
                            <form action="{{ route('product-category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada kategori yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tautan Paginasi --}}
        <div class="justify-content-between align-items-center mt-4">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </main>

    <!-- Modal untuk Tambah Kategori -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('product-category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="categoryName" name="name" required value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit Kategori -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- Form akan diperbarui oleh JavaScript --}}
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="editCategoryName" name="name" required>
                            @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addCategoryModal = document.getElementById('addCategoryModal');
            const editCategoryModal = document.getElementById('editCategoryModal');

            // JavaScript untuk form tambah kategori (jika ada error, modal tetap terbuka)
            // Cek apakah ada error validasi DAN input lama (yang menandakan POST request)
            <?php if ($errors->any() && old('name')): ?>
                const addModal = new bootstrap.Modal(addCategoryModal);
                addModal.show();
            <?php endif; ?>

            // JavaScript untuk form edit kategori
            editCategoryModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const categoryId = button.getAttribute('data-category-id');
                const categoryName = button.getAttribute('data-category-name');
                const modalForm = document.getElementById('editCategoryForm');
                const modalInput = document.getElementById('editCategoryName');

                // Menggunakan rute yang benar dan mengisinya dengan ID kategori secara aman
                modalForm.action = "{{ route('product-category.update', 'TEMP_ID') }}".replace('TEMP_ID', categoryId);

                // Masukkan nama kategori saat ini ke dalam input
                modalInput.value = categoryName;
            });

            // Logika untuk menampilkan kembali modal edit jika terjadi error validasi
            // Cek apakah ada error validasi tetapi TIDAK ada input lama (yang menandakan PUT request)
            <?php if ($errors->any() && !old('name')): ?>
                const editModal = new bootstrap.Modal(editCategoryModal);
                editModal.show();
            <?php endif; ?>
        });
    </script>
</x-mainlayout>