<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat pesanan.');
        }

        $userId = Auth::id();

        // Ambil semua pesanan untuk pengguna saat ini
        // Eager load orderItems dan product untuk setiap item
        $orders = Order::where('user_id', $userId)
            ->with('orderItems.product')
            ->latest()
            ->get();

        // Mengirimkan data orders ke view
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function whatsappMessage($orderId): RedirectResponse
    {
        // Logika untuk membuat dan mengirim pesan WhatsApp
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        $orderMessage = "Halo, saya ingin memesan produk dari K-Pop Mart.\n\n"
            . "Rincian Pesanan:\n";

        foreach ($order->orderItems as $item) {
            $itemTotal = $item->price * $item->quantity;
            $orderMessage .= "• " . $item->product->name . " x " . $item->quantity . " = Rp " . number_format($itemTotal, 0, ',', '.') . "\n";
        }

        $orderMessage .= "\n----------------------------------\n"
            . "Subtotal: Rp " . number_format($order->subtotal_amount, 0, ',', '.') . "\n"
            . "Biaya Pengiriman: Rp " . number_format($order->shipping_fee, 0, ',', '.') . "\n"
            . "Pajak (" . ($order->tax_amount / $order->subtotal_amount * 100) . "%): Rp " . number_format($order->tax_amount, 0, ',', '.') . "\n"
            . "Total Pembayaran: Rp " . number_format($order->total_payment, 0, ',', '.') . "\n\n"
            . "Mohon info ketersediaan stok dan detail pembayaran. Terima kasih.";

        $encodedMessage = urlencode($orderMessage);
        $phoneNumber = '6289513822017';
        $whatsappUrl = "https://wa.me/{$phoneNumber}?text={$encodedMessage}";

        return redirect()->away($whatsappUrl);
    }

}
