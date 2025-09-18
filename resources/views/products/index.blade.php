<x-mainlayout title="K-Pop Mart Products">
    <main class="container my-5">
        <h1 class="text-center mb-5" style="color: #7B68EE;">Semua Produk</h1>

        <div class="row mb-4">
            <div class="col-lg-6 mb-3">
                {{-- Form Pencarian --}}
                <form action="{{ url()->current() }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control rounded-pill pe-5" placeholder="Cari produk..." aria-label="Cari produk..." style="border: 1px solid #7B68EE;" value="{{ request('search') }}">
                        <span class="input-group-text bg-white border-0" style="margin-left: -50px; z-index: 10;"><i class="bi bi-search" style="color: #7B68EE;"></i></span>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-flex flex-column flex-md-row justify-content-end gap-2">
                {{-- Dropdown Kategori --}}
                <div class="dropdown me-md-2 mb-2 mb-md-0">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="dropdownKategori" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid #7B68EE; color: #495057;">
                        {{ request('category') ?? 'Kategori' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownKategori">
                        <li><a class="dropdown-item {{ request('category', 'Semua') == 'Semua' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(request()->except('category', 'page')) }}">Semua</a></li>
                        <li><a class="dropdown-item {{ request('category') == 'Album' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['category' => 'Album'])) }}">Album</a></li>
                        <li><a class="dropdown-item {{ request('category') == 'Lightstick' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['category' => 'Lightstick'])) }}">Lightstick</a></li>
                        <li><a class="dropdown-item {{ request('category') == 'Pakaian' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['category' => 'Pakaian'])) }}">Pakaian</a></li>
                        <li><a class="dropdown-item {{ request('category') == 'Aksesoris' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['category' => 'Aksesoris'])) }}">Aksesoris</a></li>
                    </ul>
                </div>
                
                {{-- Dropdown Grup --}}
                <div class="dropdown me-md-2 mb-2 mb-md-0">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="dropdownGrup" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid #7B68EE; color: #495057;">
                        {{ request('group') ?? 'Grup' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownGrup">
                        <li><a class="dropdown-item {{ request('group', 'Semua') == 'Semua' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(request()->except('group', 'page')) }}">Semua</a></li>
                        <li><a class="dropdown-item {{ request('group') == 'Seventeen' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['group' => 'Seventeen'])) }}">Seventeen</a></li>
                        <li><a class="dropdown-item {{ request('group') == 'Straykids' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['group' => 'Straykids'])) }}">Straykids</a></li>
                        <li><a class="dropdown-item {{ request('group') == 'Blackpink' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['group' => 'Blackpink'])) }}">Blackpink</a></li>
                        <li><a class="dropdown-item {{ request('group') == 'X-Heroes' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['group' => 'X-Heroes'])) }}">X-Heroes</a></li>
                        <li><a class="dropdown-item {{ request('group') == 'NCT' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['group' => 'NCT'])) }}">NCT</a></li>
                        <li><a class="dropdown-item {{ request('group') == 'Shinee' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['group' => 'Shinee'])) }}">Shinee</a></li>
                        <li><a class="dropdown-item {{ request('group') == 'EXO' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['group' => 'EXO'])) }}">EXO</a></li>
                    </ul>
                </div>

                {{-- Dropdown Harga --}}
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="dropdownSortir" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid #7B68EE; color: #495057;">
                        {{ request('sort') == 'asc' ? 'Termurah ke Termahal' : (request('sort') == 'desc' ? 'Termahal ke Termurah' : 'Harga') }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownSortir">
                        <li><a class="dropdown-item {{ request('sort', 'default') == 'default' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(request()->except('sort', 'page')) }}">Default</a></li>
                        <li><a class="dropdown-item {{ request('sort') == 'asc' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['sort' => 'asc'])) }}">Termahal ke Termurah</a></li>
                        <li><a class="dropdown-item {{ request('sort') == 'desc' ? 'active' : '' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['sort' => 'desc'])) }}">Termurah ke Termahal</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div id="productList" class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @forelse ($products as $product)
            <div class="col">
                <div class="card card-product h-100 shadow-sm">
                    <img src="{{ asset('storage/image/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 500px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                        <p class="card-text"><b>Stock: {{$product->stock}}</b></p>
                        <h4 class="fw-bold mt-auto" style="color: #FFC107;">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                        <div class="d-grid mt-2">
                            <x-detailsProductButton :product-id="$product->id" />
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center">Belum ada produk yang tersedia.</p>
            </div>
            @endforelse
        </div>

        <div class="justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </main>

    {{-- Script JavaScript dihilangkan karena filter ditangani di sisi server --}}
</x-mainlayout>