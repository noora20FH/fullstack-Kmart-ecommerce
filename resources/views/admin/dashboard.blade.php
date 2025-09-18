<x-mainlayout title="K-Pop Mart">
    <main class="container my-5">
        <h1 class="mb-4">Admin Dashboard</h1>

        <div class="row g-4">
            @foreach($data as $item )
            <!-- Kartu Ringkasan Jumlah Produk -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-white shadow-sm h-100 rounded-3" style="background:  {{$item['bg_color']}}">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title fw-semibold text-uppercase">{{$item['title']}}</h5>
                            <i class="bi {{$item['icon']}} h1 opacity-50"></i>
                        </div>
                        <h2 class="display-4 fw-bold">{{$item['value']}}</h2>
                        <p class="card-text opacity-75">{{$item['description']}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm rounded-3">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-semibold">Grafik Transaksi Mingguan</h5>
                    </div>
                    <div class="card-body">
                        <!-- Ini adalah elemen canvas untuk chart -->
                        <canvas id="weeklyTransactionChart" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm rounded-3">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-semibold">Transaksi Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <input type="text" id="searchInput" class="form-control rounded-pill" placeholder="Cari transaksi...">
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                                <select id="statusFilter" class="form-select rounded-pill">
                                    <option value="">Semua Status</option>
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>
                                    <option value="failed">Failed</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="perPageSelect" class="form-select rounded-pill">
                                    <option value="5">5 per halaman</option>
                                    <option value="10" selected>10 per halaman</option>
                                    <option value="20">20 per halaman</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Pelanggan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop untuk menampilkan data dari controller --}}
                                    @foreach($transactions as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('d M, Y') }}</td>
                                        <td>{{ $order->user->name ?? 'User Dihapus' }}</td>
                                        <td>Rp{{ number_format($order->total_payment, 0, ',', '.') }}</td>
                                        <td>
                                            @php
                                            $statusClass = [
                                            'pending' => 'warning',
                                            'completed' => 'success',
                                            'failed' => 'danger',
                                            ][$order->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $statusClass }} text-dark">{{ ucfirst($order->status) }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="justify-content-between align-items-center mt-4">
                            {{ $transactions->links('pagination::bootstrap-5') }}
                        </div>


                    </div>
                </div>
            </div>
        </div>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <style>
        .cursor-pointer {
            cursor: pointer;
        }
    </style>

    {{-- Script untuk grafik transaksi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('weeklyTransactionChart').getContext('2d');
            const weeklyTransactionChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                            label: 'Transaksi',
                            data: [12, 19, 3, 5, 20, 3, 10],
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.1,
                            fill: true
                        },
                        {
                            label: 'Volume',
                            data: [1, 13, 6, 10, 1, 4, 1],
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.1)',
                            tension: 0.1,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    <x-order-details-modal />
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const editStatusModal = document.getElementById('editStatusModal');
        const editStatusForm = document.getElementById('editStatusForm');
        const statusSelect = document.getElementById('statusSelect');
        const modalOrderId = document.getElementById('modalOrderId');

        editStatusModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const orderId = button.getAttribute('data-order-id');
            const currentStatus = button.getAttribute('data-current-status');

            modalOrderId.value = orderId;
            statusSelect.value = currentStatus;

            // Atur action form menggunakan helper route()
            editStatusForm.action = "{{ route('admin.orders.updateStatus', ['order' => 'TEMP_ID']) }}".replace('TEMP_ID', orderId);
        });

        editStatusForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST', // Gunakan POST
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                // Tangani jika respons tidak berhasil
                if (!response.ok) {
                    // Jika ada error validasi atau server, lemparkan error
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                // Logika penyimpanan data berhasil
                console.log('Data berhasil disimpan:', data.message);
                
                // Tutup modal setelah berhasil
                const modal = bootstrap.Modal.getInstance(editStatusModal);
                modal.hide();

                // Lakukan reload halaman agar data di tabel terupdate
                window.location.reload();
            })
            .catch(error => {
                // Tampilkan pesan error jika ada masalah
                console.error('Error:', error);
                alert('Gagal memperbarui status. Silakan coba lagi.');
            });
        });
    });
</script>
</x-mainlayout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderDetailModal = new bootstrap.Modal(document.getElementById('orderDetailModal'));
        const modalContent = document.getElementById('modal-content-container');
        const loadingSpinner = document.getElementById('loading-spinner');

        // Delegasi event untuk tombol View
        document.querySelector('table tbody').addEventListener('click', function(event) {
            if (event.target.tagName === 'A' && event.target.textContent.trim() === 'View') {
                event.preventDefault();
                const orderId = event.target.closest('tr').querySelector('td:first-child').textContent.replace('#', '').trim();

                // Tampilkan spinner dan sembunyikan konten
                loadingSpinner.style.display = 'block';
                modalContent.style.display = 'none';

                // Tampilkan modal
                orderDetailModal.show();

                fetch(`/dashboard/order-details?order_id=${orderId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            orderDetailModal.hide();
                            return;
                        }

                        // Sembunyikan spinner dan tampilkan konten
                        loadingSpinner.style.display = 'none';
                        modalContent.style.display = 'block';

                        // Isi data ke dalam modal
                        document.getElementById('modal-order-id').textContent = `#${data.id}`;
                        document.getElementById('modal-order-status').textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                        document.getElementById('modal-order-date').textContent = new Date(data.created_at).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric'
                        });
                        document.getElementById('modal-customer-name').textContent = data.user.name;
                        document.getElementById('modal-customer-email').textContent = data.user.email;
                        document.getElementById('modal-customer-phone').textContent = data.user.phone || '-';

                        document.getElementById('modal-subtotal').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.subtotal_amount)}`;
                        document.getElementById('modal-shipping').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.shipping_fee)}`;
                        document.getElementById('modal-total').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.total_payment)}`;

                        // Isi tabel item pesanan
                        const itemsTableBody = document.getElementById('modal-order-items');
                        itemsTableBody.innerHTML = '';
                        data.order_items.forEach(item => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${item.product.name}</td>
                                <td>${item.quantity}</td>
                                <td>Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</td>
                                <td class="text-end">Rp ${new Intl.NumberFormat('id-ID').format(item.quantity * item.price)}</td>
                            `;
                            itemsTableBody.appendChild(row);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching order details:', error);
                        loadingSpinner.style.display = 'none';
                        alert('Gagal mengambil detail pesanan. Silakan coba lagi.');
                    });
            }
        });
    });
</script>
