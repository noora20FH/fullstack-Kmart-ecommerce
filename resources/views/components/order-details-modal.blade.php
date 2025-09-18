<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailModalLabel">Detail Pesanan <span id="modal-order-id"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center" id="loading-spinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div id="modal-content-container" style="display: none;">
                    <p class="mb-1"><strong>Status:</strong> <span id="modal-order-status"></span></p>
                    <p class="mb-3"><strong>Tanggal Pesanan:</strong> <span id="modal-order-date"></span></p>

                    <h5 class="fw-bold mt-4">Detail Pelanggan</h5>
                    <p class="mb-1"><strong>Nama:</strong> <span id="modal-customer-name"></span></p>
                    <p class="mb-1"><strong>Email:</strong> <span id="modal-customer-email"></span></p>
                    <p class="mb-1"><strong>Nomor Telepon:</strong> <span id="modal-customer-phone"></span></p>

                    <h5 class="fw-bold mt-4">Ringkasan Pembayaran</h5>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Subtotal Produk</span>
                            <span id="modal-subtotal"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Biaya Pengiriman</span>
                            <span id="modal-shipping"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between fw-bold">
                            <span>Total Pembayaran</span>
                            <span id="modal-total" class="text-success"></span>
                        </li>
                    </ul>

                    <h5 class="fw-bold mt-4">Item Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga Satuan</th>
                                    <th scope="col" class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="modal-order-items">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>