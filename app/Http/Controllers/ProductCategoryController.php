<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::withCount('products')
            ->withSum('products', 'price')
            ->paginate(5);
        return view('admin.product-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Langsung validasi, Laravel akan menangani redirect jika gagal
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
        ]);

        // Jika validasi sukses, buat kategori baru
        ProductCategory::create([
            'name' => $request->name,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        // Validasi permintaan. Gunakan ID kategori yang terikat untuk mengabaikan dirinya sendiri
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:product_categories,name,' . $productCategory->id
            ],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah ada.'
        ]);

        // Perbarui nama kategori
        $productCategory->name = $request->name;
        $productCategory->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        // Hapus kategori
        $productCategory->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Kategori berhasil dihapus!');
    
    
        
    }
}
