<?php

// app/Http/Controllers/OrderAdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderAdminController extends Controller
{
    /**
     * Memperbarui status pesanan secara manual.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Ambil nilai perPage dari request, default-nya 10
        $perPage = $request->input('perPage', 10);

        // Langsung terapkan paginasi pada query
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:pending,completed,failed',
        ]);

        try {
            // Perbarui status order
            $order->status = $request->status;
            $order->save();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            return redirect()->back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }
}
