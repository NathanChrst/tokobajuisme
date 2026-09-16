<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = auth()->user()->wishlists()
            ->with(['product.images', 'product.brand', 'product.variants'])
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $exists = auth()->user()->wishlists()
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return back()->with('info', 'Produk sudah ada di wishlist.');
        }

        auth()->user()->wishlists()->create([
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'Produk ditambahkan ke wishlist! ❤️');
    }

    public function destroy(Product $product)
    {
        auth()->user()->wishlists()
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Produk dihapus dari wishlist.');
    }
}
