   // Data produk contoh

        const productList = document.getElementById('productList');
        const filterButtons = document.getElementById('filter-buttons');
        const productSectionTitle = document.getElementById('product-section-title');

        // Fungsi untuk membuat tombol filter grup secara dinamis
        const createGroupFilters = () => {
            // Dapatkan semua grup unik dari data produk
            const uniqueGroups = [...new Set(Product.map(p => p.group))];

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
            let filteredProducts = [...Product];

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