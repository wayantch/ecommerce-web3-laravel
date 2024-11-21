<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',  // Pastikan product_id ada dan valid
            'quantity' => 'required|integer|min:1'  // Pastikan quantity lebih dari 0
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Cari produk berdasarkan ID
        $product = Product::find($validated['product_id']);

        // Tambahkan produk ke cart
        $cart = Cart::updateOrCreate(
            [
                'user_id' => $user->id,
                'product_id' => $product->id,
            ],
            [
                'quantity' => \DB::raw('quantity + ' . $validated['quantity']),  // Update jumlah jika produk sudah ada di cart
            ]
        );

        return response()->json([
            'message' => 'Product added to cart successfully.',
            'cart' => $cart
        ], 200);
    }
}
