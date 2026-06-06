<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): View
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'Produk ditambahkan ke wishlist.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Produk dihapus dari wishlist.');
    }
}
