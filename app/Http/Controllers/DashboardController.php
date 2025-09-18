<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;

class DashboardController extends Controller
{
    public function transactionList()
    {
        // Mengambil semua order dengan relasi user dan orderItems
        // Mengurutkan berdasarkan tanggal terbaru
        $orders = Order::with('user', 'orderItems.product')
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengirimkan data orders ke view
        return view('admin.dashboard.transactionList', ['orders' => $orders]);
    }
    public function index(Request $request)
    {
        $totalProducts = Product::count();
        $totalCategories = ProductCategory::count();
        $totalStocks = Product::sum('stock');
        $totalClicks = Product::sum('click_count');
        $data = [
            ['title' => 'Jumlah Produk', 'icon' => 'bi-box-seam', 'value' => $totalProducts, 'description' => 'Produk aktif', 'bg_color' => 'linear-gradient(135deg, #2193b0 0%, #6dd5ed 60%, #1e3c72 100%)'],
            ['title' => 'Jumlah Kategori', 'icon' => 'bi-tags', 'value' => $totalCategories, 'description' => 'Kategori tersedia', 'bg_color' => 'linear-gradient(135deg,  #fff700 0%, #ffe066 60%, #ffd700 100%)'],
            ['title' => 'Total Stok Produk', 'icon' => 'bi-stack', 'value' => $totalStocks, 'description' => 'Stok keseluruhan', 'bg_color' => 'linear-gradient(135deg,#ff5eae 0%, #d72660 60%, #7f53ac 100%)'],
            ['title' => 'Total Klik Produk', 'icon' => 'bi-graph-up', 'value' => $totalClicks, 'description' => 'Klik dalam 30 hari terakhir', 'bg_color' => 'linear-gradient(135deg, #38f9d7 0%, #00ffff 70%, #43e97b 100%)'],
        ];
        // Logika untuk tabel transaksi
        $transactions = Order::with('user');

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status != '') {
            $transactions->where('status', $request->status);
        }

        // Filter berdasarkan pencarian jika ada
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $transactions->whereHas('user', function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            })->orWhere('id', 'like', $searchTerm);
        }

        // Terapkan paginasi
        $perPage = $request->input('perPage', 10);
        $transactions = $transactions->paginate($perPage)->withQueryString();

        return view('admin.dashboard', compact('data', 'transactions'));
    }
        public function getOrderDetails(Request $request)
    {
        $orderId = $request->input('order_id');
        
        $order = Order::with(['user', 'orderItems.product'])
                      ->find($orderId);

        if (!$order) {
            return response()->json(['error' => 'Order not found.'], 404);
        }

        return response()->json($order);
    }
    
    // public function updateStatus(Request $request, Order $order)
    // {
    //     try {
    //         // Validasi input status
    //         $validatedData = $request->validate([
    //             'status' => 'required|in:pending,completed,failed',
    //         ]);

    //         // Perbarui properti status dari objek Order
    //         $order->status = $validatedData['status'];
            
    //         // Simpan perubahan ke database
    //         $order->save();

    //         // Berikan respons JSON sukses
    //         return response()->json([
    //             'message' => 'Status pesanan berhasil diperbarui.',
    //             'new_status' => $order->status
    //         ], 200);

    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Tangani error validasi
    //         return response()->json(['error' => $e->errors()], 422);
    //     } catch (\Exception $e) {
    //         // Tangani error umum lainnya
    //         return response()->json(['error' => 'Gagal memperbarui status. ' . $e->getMessage()], 500);
    //     }
    // }
}
