<x-mainlayout title="Manajemen Pesanan">

    <main class="container my-5">
        <h1 class="mb-4">Manajemen Pesanan</h1>

        {{-- Pesan Notifikasi Sukses/Gagal --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tabel Responsif --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Total</th>
                        <th scope="col">Metode Pembayaran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <th scope="row">#{{ $order->id }}</th>
                        <td>{{ $order->user->name ?? 'User Dihapus' }}</td>
                        <td>{{ $order->created_at->format('d M, Y H:i') }}</td>
                        <td>Rp {{ number_format($order->total_payment, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
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
                            {{-- Tombol Edit Status yang memicu modal --}}
                            <button type="button" class="btn btn-sm btn-warning edit-status-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editStatusModal"
                                data-order-id="{{ $order->id }}"
                                data-current-status="{{ $order->status }}">
                                Edit Status
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada pesanan yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tautan Paginasi --}}
        <div class="justify-content-between align-items-center mt-4">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </main>

    <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStatusModalLabel">Edit Status Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- Menggunakan POST di form, dan PATCH melalui method helper Laravel --}}
                <form id="editStatusForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" id="modalOrderId" name="order_id">
                        <div class="mb-3">
                            <label for="statusSelect" class="form-label">Status</label>
                            <select class="form-select" id="statusSelect" name="status">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Perbarui Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editStatusModal = document.getElementById('editStatusModal');
            editStatusModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const orderId = button.getAttribute('data-order-id');
                const currentStatus = button.getAttribute('data-current-status');
                const modalForm = document.getElementById('editStatusForm');
                const statusSelect = document.getElementById('statusSelect');

                // Masukkan ID dan status saat ini ke dalam modal
                statusSelect.value = currentStatus;

                // Perbarui URL form action dengan ID pesanan
                modalForm.action = `/admin/orders/${orderId}/update-status`;
            });
        });
    </script>
</x-mainlayout>