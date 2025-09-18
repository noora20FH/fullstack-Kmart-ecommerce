<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js"></script>
</head>

<body>
    @include('partials.navbar')
    {{ $slot }}

    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Direktori public/js -->

    <script src="js/navbar.js"></script>
    <script src="js/profile.js"></script>
    <!-- <script>
        // Data produk contoh
        const allProducts = [{
                name: "Album 'Don't Wanna Cry'",
                group: "Seventeen",
                category: "Album",
                price: 350000,
                image: "https://via.placeholder.com/400x400/9370DB/FFFFFF?text=Album+Seventeen",
                description: "Album lengkap dengan photocard dan poster.",
                isNew: true
            }, {
                name: "Lightstick 'Carat Bong'",
                group: "Seventeen",
                category: "Lightstick",
                price: 600000,
                image: "https://via.placeholder.com/400x400/87CEEB/FFFFFF?text=Lightstick+Seventeen",
                description: "Lightstick official untuk konser.",
                isNew: false
            }, {
                name: "Album 'S-Class'",
                group: "Straykids",
                category: "Album",
                price: 380000,
                image: "https://via.placeholder.com/400x400/FFB6C1/FFFFFF?text=Album+Straykids",
                description: "Album terbaru dengan photocard eksklusif.",
                isNew: true
            }, {
                name: "Hoodie 'Blackpink'",
                group: "Blackpink",
                category: "Pakaian",
                price: 475000,
                image: "https://via.placeholder.com/400x400/DA70D6/FFFFFF?text=Hoodie+Blackpink",
                description: "Hoodie official untuk penggemar Blackpink.",
                isNew: false
            }, {
                name: "Album 'Overload'",
                group: "X-Heroes",
                category: "Album",
                price: 250000,
                image: "https://via.placeholder.com/400x400/9370DB/FFFFFF?text=Album+X-Heroes",
                description: "Mini album pertama dari Xdinary Heroes.",
                isNew: true
            }, {
                name: "Kaos 'NCTzen'",
                group: "NCT",
                category: "Pakaian",
                price: 180000,
                image: "https://via.placeholder.com/400x400/87CEEB/FFFFFF?text=Kaos+NCT",
                description: "Kaos fanmade dengan logo NCTzen.",
                isNew: false
            }, {
                name: "Album 'Odd Eye'",
                group: "Shinee",
                category: "Album",
                price: 300000,
                image: "https://via.placeholder.com/400x400/FFB6C1/FFFFFF?text=Album+Shinee",
                description: "Album comeback Shinee.",
                isNew: true
            }, {
                name: "Photocard 'EXO'",
                group: "EXO",
                category: "Aksesoris",
                price: 120000,
                image: "https://via.placeholder.com/400x400/DA70D6/FFFFFF?text=Photocard+EXO",
                description: "Set photocard edisi terbatas.",
                isNew: false
            }, {
                name: "Lightstick 'Lightstick Pink'",
                group: "Blackpink",
                category: "Lightstick",
                price: 750000,
                image: "https://via.placeholder.com/400x400/FF69B4/FFFFFF?text=Lightstick+BP",
                description: "Lightstick official untuk Blinks.",
                isNew: false
            }, {
                name: "Tote Bag 'Straykids'",
                group: "Straykids",
                category: "Pakaian",
                price: 150000,
                image: "https://via.placeholder.com/400x400/808080/FFFFFF?text=Tote+Bag+SKZ",
                description: "Tote bag official Straykids.",
                isNew: true
            }, {
                name: "Keychain 'EXO'",
                group: "EXO",
                category: "Aksesoris",
                price: 85000,
                image: "https://via.placeholder.com/400x400/4169E1/FFFFFF?text=Keychain+EXO",
                description: "Gantungan kunci official EXO.",
                isNew: false
            },
            {
                name: "T-Shirt 'Blackpink in Your Area'",
                group: "Blackpink",
                category: "Pakaian",
                price: 250000.00,
                image: "https://via.placeholder.com/400x400/BDB76B/FFFFFF?text=T-Shirt+Blackpink",
                description: "T-shirt official dari tur Blackpink.",
                isNew: true
            },
            {
                name: "Hoodie 'EXO Planet'",
                group: "EXO",
                category: "Pakaian",
                price: 480000.00,
                image: "https://via.placeholder.com/400x400/4682B4/FFFFFF?text=Hoodie+EXO",
                description: "Hoodie official dari tur konser EXO.",
                isNew: false
            },
            {
                name: "Photocard 'NCT Dream'",
                group: "NCT Dream",
                category: "Aksesoris",
                price: 130000.00,
                image: "https://via.placeholder.com/400x400/90EE90/FFFFFF?text=Photocard+NCT+Dream",
                description: "Set photocard edisi khusus dari NCT Dream.",
                isNew: false
            },
            {
                name: "Hoodie 'Seventeen'",
                group: "Seventeen",
                category: "Pakaian",
                price: 490000.00,
                image: "https://via.placeholder.com/400x400/9370DB/FFFFFF?text=Hoodie+Seventeen",
                description: "Hoodie official untuk penggemar Seventeen.",
                isNew: false
            },
            {
                name: "Album 'Glitch Mode'",
                group: "NCT Dream",
                category: "Album",
                price: 315000.00,
                image: "https://via.placeholder.com/400x400/6A5ACD/FFFFFF?text=Album+NCT+Dream",
                description: "Album studio kedua dari NCT Dream.",
                isNew: true
            },
            {
                name: "Lightstick 'Eri-bong'",
                group: "EXO",
                category: "Lightstick",
                price: 610000.00,
                image: "https://via.placeholder.com/400x400/BDB76B/FFFFFF?text=Lightstick+EXO",
                description: "Lightstick resmi untuk penggemar EXO.",
                isNew: false
            },
            {
                name: "T-Shirt 'Stray Kids'",
                group: "Stray Kids",
                category: "Pakaian",
                price: 210000.00,
                image: "https://via.placeholder.com/400x400/808080/FFFFFF?text=T-Shirt+Stray+Kids",
                description: "T-shirt official dari Stray Kids.",
                isNew: true
            },
            {
                name: "Keyring 'Blackpink'",
                group: "Blackpink",
                category: "Aksesoris",
                price: 95000.00,
                image: "https://via.placeholder.com/400x400/FF69B4/FFFFFF?text=Keyring+Blackpink",
                description: "Gantungan kunci official Blackpink.",
                isNew: false
            },
            {
                name: "Album 'NCT 2020 Resonance Pt. 1'",
                group: "NCT",
                category: "Album",
                price: 360000,
                image: "https://via.placeholder.com/400x400/3CB371/FFFFFF?text=Album+NCT",
                description: "Album studio kedua dari NCT.",
                isNew: false
            }
        ];

        const productList = document.getElementById('productList');
        const filterButtons = document.getElementById('filter-buttons');
        const productSectionTitle = document.getElementById('product-section-title');

        // Fungsi untuk membuat tombol filter grup secara dinamis
        const createGroupFilters = () => {
            // Dapatkan semua grup unik dari data produk
            const uniqueGroups = [...new Set(allProducts.map(p => p.group))];

            // Kosongkan container filter sebelumnya
            filterButtons.innerHTML = '';

            // Buat tombol untuk setiap grup unik
            uniqueGroups.forEach(group => {
                const button = document.createElement('button');
                button.classList.add('btn', 'rounded-pill', 'px-4', 'filter-btn', 'btn-outline-primary');
                button.dataset.group = group;
                button.textContent = group;
                filterButtons.appendChild(button);
            });
        };

        // Fungsi untuk merender produk berdasarkan grup
        const renderProductsByGroup = (groupName) => {
            let filteredProducts = [...allProducts];

            // Filter berdasarkan grup
            if (groupName) {
                filteredProducts = filteredProducts.filter(p => p.group === groupName);
                productSectionTitle.textContent = groupName;
            } else {
                // Tampilkan semua produk jika tidak ada grup yang dipilih
                productSectionTitle.textContent = 'Semua Produk';
            }

            // Batasi hanya satu baris produk (misalnya, 4 produk)
            const productsToDisplay = filteredProducts.slice(0, 4);

            // Kosongkan daftar produk
            productList.innerHTML = '';

            if (productsToDisplay.length === 0) {
                productList.innerHTML = '<div class="col-12 text-center mt-5"><p class="lead text-muted">Tidak ada produk yang ditemukan untuk grup ini.</p></div>';
                return;
            }

            // Loop untuk membuat card produk
            productsToDisplay.forEach(product => {
                const col = document.createElement('div');
                col.classList.add('col');
                col.innerHTML = `
                    <div class="card h-100 shadow-sm">
                        <img src="${product.image}" class="card-img-top" alt="${product.name}" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                            ${product.isNew ? '<span class="badge bg-warning text-dark mb-2">Baru</span>' : ''}
                            <h4 class="fw-bold mt-auto" style="color: #FFC107;">Rp ${product.price.toLocaleString('id-ID')}</h4>
                            <div class="d-grid mt-2">
                                <a href="#" class="btn" style="background-color: #7B68EE; border-color: #7B68EE; color: white;">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                `;
                productList.appendChild(col);
            });
        };


        // Event listener untuk filter grup
        filterButtons.addEventListener('click', (e) => {
            if (e.target.tagName === 'BUTTON') {
                const groupName = e.target.dataset.group;

                // Hapus kelas 'active' dari semua tombol, lalu tambahkan ke tombol yang diklik
                filterButtons.querySelectorAll('.filter-btn').forEach(item => {
                    item.classList.remove('active');
                    item.classList.add('btn-outline-primary');
                });
                e.target.classList.add('active');
                e.target.classList.remove('btn-outline-primary');

                renderProductsByGroup(groupName);
            }
        });

        // Panggil fungsi untuk membuat tombol filter saat halaman pertama kali dimuat
        createGroupFilters();

        // Tampilkan produk dari grup pertama secara default
        const firstGroupButton = filterButtons.querySelector('button');
        if (firstGroupButton) {
            firstGroupButton.click();
        }
    </script> -->
    <!-- <script>
        // Logika untuk menyembunyikan/menampilkan elemen navbar berdasarkan route
        const customerHomeNav = document.getElementById('customer-home');
        const homeNav = document.getElementById('home');
        const currentPath = window.location.pathname;

        // Secara default, sembunyikan keduanyaF
        customerHomeNav.classList.add('d-none');
        homeNav.classList.add('d-none');

        // Tampilkan yang sesuai berdasarkan URL
        if (currentPath === '/') {
            // Tampilkan tombol untuk halaman utama (login/daftar)
            homeNav.classList.remove('d-none');
        } else {
            // Tampilkan ikon keranjang dan profil untuk customer
            customerHomeNav.classList.remove('d-none');
        }
    </script> -->

    <!-- Profile Edit -->

    <!-- <script>
        const profileImage = document.getElementById('profile-image');
        const profilePhotoUpload = document.getElementById('profile-photo-upload');

        profilePhotoUpload.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    profileImage.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script> -->
</body>

</html>