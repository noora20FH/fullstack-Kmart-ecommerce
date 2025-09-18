<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $query = Product::query();

    // Menggunakan eager loading untuk memuat data kategori
    $query->with('category');

    // Filter Berdasarkan Kategori
    if ($request->has('category') && $request->category !== 'Semua') {
        // Gunakan whereHas untuk memfilter berdasarkan nama kategori
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('name', $request->category);
        });
    }

    // Filter Berdasarkan Grup
    if ($request->has('group') && $request->group !== 'Semua') {
        $query->where('group', $request->group);
    }

    // Filter Berdasarkan Pencarian (Search)
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Urutkan (Sort) Berdasarkan Harga
    if ($request->has('sort')) {
        if ($request->sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('price', 'desc');
        }
    }

        // Ambil produk dengan pagination
        $products = $query->paginate(8)->withQueryString();

        // Kirim data ke view
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan view untuk form tambah produk baru
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Tampilkan view 'products.show' dengan detail produk
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Tampilkan view 'products.edit' dengan data produk yang akan diedit
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|url',
            'category' => 'nullable|string|max:255', // Validasi untuk kategori
        ]);

        // Update data produk
        $product->update($validatedData);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Hapus produk
        $product->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
    public function recordClick(Product $product, Request $request): Response
    {
        // Mendapatkan array ID produk yang sudah diklik dari sesi
        $clickedProducts = $request->session()->get('clicked_products', []);

        // Memeriksa apakah ID produk saat ini sudah ada di sesi
        if (!in_array($product->id, $clickedProducts)) {
            // Jika belum ada, tambahkan 1 ke click_count di database
            $product->increment('click_count');

            // Tambahkan ID produk ke array di sesi
            $clickedProducts[] = $product->id;
            $request->session()->put('clicked_products', $clickedProducts);
        }

        // Kembalikan respons 204 (tanpa konten)
        return response()->noContent();
    }
}
