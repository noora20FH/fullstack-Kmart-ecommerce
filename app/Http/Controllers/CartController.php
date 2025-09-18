<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja dengan isinya.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $cart = $user->cart()->with('items.product')->firstOrCreate(['user_id' => $user->id]);

        $subtotal = 0;
        foreach ($cart->items as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        $shipping = 25000;
        $tax = 0;
        $total = $subtotal + $shipping + $tax;

        return view('cart', [
            'cartItems' => $cart->items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total,
        ]);
    }

    /**
     * Menambahkan produk baru ke keranjang belanja pengguna.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $user = $request->user();

        DB::beginTransaction();

        try {
            $cart = $user->cart()->firstOrCreate();

            $cartItem = $cart->items()->where('product_id', $validated['product_id'])->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $validated['quantity']);
            } else {
                $cart->items()->create([
                    'product_id' => $validated['product_id'],
                    'quantity' => $validated['quantity'],
                ]);
            }

            DB::commit();

            return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan produk. Silakan coba lagi.');
        }
    }

    /**
     * Memperbarui kuantitas produk di keranjang.
     */
    public function update(Request $request): RedirectResponse
    {
        // Ganti validasi minimal 'quantity' menjadi 0
        $validated = $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:0',
        ]);

        $user = $request->user();
        DB::beginTransaction();

        $itemsDeleted = 0;
        $itemsUpdated = 0;

        try {
            foreach ($validated['quantities'] as $cartItemId => $newQuantity) {
                $cartItem = CartItem::find($cartItemId);

                if ($cartItem && $cartItem->cart->user_id === $user->id) {
                    if ($newQuantity == 0) {
                        // Jika kuantitasnya 0, hapus item
                        $cartItem->delete();
                        $itemsDeleted++;
                    } else {
                        // Jika kuantitas > 0, perbarui kuantitasnya
                        $cartItem->update(['quantity' => $newQuantity]);
                        $itemsUpdated++;
                    }
                }
            }
            DB::commit();

            $message = '';
            if ($itemsUpdated > 0) {
                $message .= "Berhasil memperbarui $itemsUpdated item. ";
            }
            if ($itemsDeleted > 0) {
                $message .= "Berhasil menghapus $itemsDeleted item. ";
            }

            return redirect()->route('cart.index')->with('success', trim($message));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui keranjang. Silakan coba lagi.');
        }
    }

    /**
     * Menghapus satu item produk dari keranjang.
     */
    public function destroy(CartItem $item)
    {
        $item->delete();
        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus!');
    }
}
