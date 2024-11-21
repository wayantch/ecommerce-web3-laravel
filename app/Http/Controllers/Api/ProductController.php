<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Set image_path ke null terlebih dahulu
        $image_path = null;

        // Jika ada file gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Menyimpan gambar di 'public/images' dan mendapatkan path lengkap
            $image_path = $image->storeAs('public/images', $image->hashName());
        }

        // Membuat data produk
        $product = Product::create([
            'price' => $request->price,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_path ? basename($image_path) : null, // Menyimpan nama file gambar atau null
        ]);

        return new ProductResource(true, 'Data Product Berhasil Ditambahkan!', $product);
    }


    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/images', $image->hashName());
            $product->image = $image->hashName();
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();

        return new ProductResource(true, 'Data Product Berhasil Diubah!', $product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // Cek apakah ada gambar terkait produk dan jika ada, hapus file gambar
        if ($product->image) {
            $imagePath = public_path('storage/' . $product->image);

            // Pastikan file ada sebelum menghapusnya
            if (file_exists($imagePath)) {
                unlink($imagePath); // Menghapus file gambar
            }
        }

        // Hapus data produk dari database
        $product->delete();
        return new ProductResource(true, 'Data Product Berhasil Dihapus!', $product);
    }
}
