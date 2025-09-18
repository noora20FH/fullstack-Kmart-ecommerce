<x-mainlayout title="K-Pop Mart">
    <main class="container my-5">
        <h1>Tambah Produk Baru</h1>
        <hr>

        <form action="{{ route('admin-products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="group" class="form-label">Grup</label>
                <input type="text" class="form-control @error('group') is-invalid @enderror" id="group" name="group" value="{{ old('group') }}" required>
                @error('group')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="500" min="0" value="{{ old('price') }}" required>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" min="0" value="{{ old('stock') }}" required>
                @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Saat Ini</label>
                <div>
                    {{-- Perbaikan: Menggunakan asset('storage/...') untuk path yang benar --}}
                    <img src="{{ asset('storage/image/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mb-2" style="width: 150px;">
                </div>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="isNew" name="isNew" value="1" {{ old('isNew') ? 'checked' : '' }}>
                <label class="form-check-label" for="isNew">Produk Baru</label>
            </div>

            <button type="submit" class="btn btn-success">Simpan Produk</button>
            <a href="{{ route('admin-products.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </main>
</x-mainlayout>