<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout dengan item yang dipilih.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Ambil data user yang sedang login
        $user = Auth::user();

        // 2. Ambil semua item keranjang untuk user yang sedang login
        $checkoutItems = CheckoutItem::where('user_id', $user->id)
            ->with('product')
            ->get();
        $tax_rate = 0.1; // 10%
        $shipping_cost = 10000; // Biaya pengiriman tetap

        $subtotal = $checkoutItems->sum('subtotal');
        $tax_amount = $subtotal * $tax_rate;
        $total_amount = $subtotal + $shipping_cost + $tax_amount;

        $checkoutListProduct = (object)[
            'user' => $user,
            'checkoutItems' => $checkoutItems, // Menggunakan item checkout

            'shipping_cost' => $shipping_cost,
            'tax_amount' => $tax_amount,
            'total_amount' => $total_amount,
        ];

        // Membuat objek ringkasan
        $checkoutSummary = (object)[
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping_cost,
            'tax_amount' => $tax_amount,
            'total_amount' => $total_amount,
        ];
        return view('checkout.index', [
            'checkout' => $checkoutListProduct,
            'summary' => $checkoutSummary,
        ]);
    }

    /**
     * Tangani item yang dipilih dari halaman keranjang dan simpan ke sesi.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */


    /**
     * @param int $id ID dari CartItem.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function singleItemCheckout(Request $request , $id)
    {
        // Cari item di keranjang hanya berdasarkan ID-nya
        $cartItem = CartItem::where('id', $id)->with('product')->first();

        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan.');
        }

        // Gunakan transaksi database untuk memastikan proses atomik
        DB::beginTransaction();

        try {
            // Hitung harga untuk item tunggal
            $subtotal = $cartItem->product->price * $cartItem->quantity;

            // 2. Simpan detail produk ke tabel `checkout_items`
            $checkoutItem = new CheckoutItem();
            $checkoutItem->user_id = Auth::id();
            $checkoutItem->product_id = $cartItem->product_id;
            $checkoutItem->quantity = $cartItem->quantity;
            $checkoutItem->price = $cartItem->product->price;
            $checkoutItem->subtotal = $subtotal;
            $checkoutItem->save();

            // 3. Hapus item dari tabel `cart_items`
            $cartItem->delete();

            // Commit transaksi jika semua langkah berhasil
            DB::commit();

            return redirect()->route('cart.index')->with('success', 'Item berhasil di-checkout dan diproses!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            return redirect()->route('cart.index')->with('error', 'Gagal memproses checkout. Silakan coba lagi.');
        }
    }
    public function processCheckout(): RedirectResponse
    {
        // 1. Ambil data user yang sedang login
        $user = Auth::user();

        // 2. Ambil semua item yang ada di tabel 'checkout_items' untuk user ini
        $checkoutItems = CheckoutItem::where('user_id', $user->id)->with('product')->get();

        // 3. Cek jika tidak ada item untuk diproses
        if ($checkoutItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk diproses checkout.');
        }

        // Gunakan transaksi database untuk memastikan proses atomik
        DB::beginTransaction();

        try {
            // 4. Hitung total biaya
            $subtotal = $checkoutItems->sum('subtotal');
            $taxRate = 0.1;
            $shippingCost = 10000;
            $taxAmount = $subtotal * $taxRate;
            $finalTotal = $subtotal + $shippingCost + $taxAmount;

            // 5. Buat entri baru di tabel 'orders'
            $order = Order::create([
                'user_id' => $user->id,
                'customer_name' => $user->name,
                'customer_phone' => $user->phone,
                'customer_address' => $user->address,
                'subtotal_amount' => $subtotal,
                'shipping_fee' => $shippingCost,
                'tax_amount' => $taxAmount,
                'total_payment' => $finalTotal,
                'payment_method' => 'WhatsApp',
                'status' => 'pending',
            ]);

            // 6. Loop melalui checkout items untuk membuat order items dan pesan WhatsApp
            $orderMessage = "Halo, saya ingin memesan produk dari K-Pop Mart.\n\n"
                . "Rincian Pesanan:\n";

            foreach ($checkoutItems as $item) {
                // Simpan setiap item ke tabel 'order_items'
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                // Tambahkan detail produk ke pesan WhatsApp
                $itemTotal = $item->price * $item->quantity;
                $orderMessage .= "• " . $item->product->name . " x " . $item->quantity . " = Rp " . number_format($itemTotal, 0, ',', '.') . "\n";
            }

            // 7. Hapus semua item dari tabel 'checkout_items' setelah berhasil dipindahkan ke 'orders'
            CheckoutItem::where('user_id', $user->id)->delete();

            // 8. Commit transaksi jika semua langkah berhasil
            DB::commit();

            // 9. Lanjutkan dengan pembuatan pesan WhatsApp
            $orderMessage .= "\n----------------------------------\n"
                . "Subtotal: Rp " . number_format($subtotal, 0, ',', '.') . "\n"
                . "Biaya Pengiriman: Rp " . number_format($shippingCost, 0, ',', '.') . "\n"
                . "Pajak (" . ($taxRate * 100) . "%): Rp " . number_format($taxAmount, 0, ',', '.') . "\n"
                . "Total Pembayaran: Rp " . number_format($finalTotal, 0, ',', '.') . "\n\n"
                . "Mohon info ketersediaan stok dan detail pembayaran. Terima kasih.";

            $encodedMessage = urlencode($orderMessage);
            $phoneNumber = '6289513822017';
            $whatsappUrl = "https://wa.me/{$phoneNumber}?text={$encodedMessage}";

            return redirect()->away($whatsappUrl);
        } catch (\Exception $e) {
            // 10. Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            return redirect()->route('cart.index')->with('error', 'Gagal memproses checkout. Silakan coba lagi.');
        }
    }
}
