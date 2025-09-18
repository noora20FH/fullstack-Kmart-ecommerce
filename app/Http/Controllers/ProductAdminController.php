<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= ProductCategory::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg,webp',
            'description' => 'nullable|string',
            'isNew' => 'nullable',
        ]);

        try {
            // Menggunakan Storage facade untuk menyimpan gambar
            $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('image', $request->file('image'), $imageName);

            // Membuat produk baru
            $product = new Product();
            $product->name = $validatedData['name'];
            $product->group = $validatedData['group'];
            $product->product_category_id = $validatedData['category_id'];
            $product->price = $validatedData['price'];
            $product->stock = $validatedData['stock'];
            $product->description = $validatedData['description'];
            $product->image = $imageName;
            $product->isNew = $request->has('isNew') ? true : false;
            $product->save();

            return redirect()->route('admin-products.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Load relasi kategori untuk produk yang sedang diedit.
        $product->load('category');

        // Ambil semua kategori dari database untuk dropdown.
        $categories = ProductCategory::all();
        
        // Kirim data produk dan semua kategori ke view.
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,webp',
            'description' => 'nullable|string',
            'isNew' => 'nullable',
        ]);

        try {
            if ($request->hasFile('image')) {
                // Hapus gambar lama dari storage jika ada
                if ($product->image && Storage::disk('public')->exists('image/' . $product->image)) {
                    Storage::disk('public')->delete('image/' . $product->image);
                }

                // Unggah gambar baru ke storage
                $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('image', $request->file('image'), $imageName);
                $validatedData['image'] = $imageName;
            } else {
                // Jika tidak ada gambar baru, pertahankan gambar lama
                $validatedData['image'] = $product->image;
            }

            // Perbarui data produk
            $product->name = $validatedData['name'];
            $product->group = $validatedData['group'];
            $product->product_category_id = $validatedData['category_id'];
            $product->price = $validatedData['price'];
            $product->stock = $validatedData['stock'];
            $product->description = $validatedData['description'];
            $product->isNew = $request->has('isNew') ? true : false;
            $product->image = $validatedData['image'];

            $product->save();

            return redirect()->route('admin-products.index')->with('success', 'Produk berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui produk: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         $product->delete();

        return redirect()->route('admin-products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
