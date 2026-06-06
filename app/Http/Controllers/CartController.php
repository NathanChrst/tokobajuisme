<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $total = $cartItems->sum(fn ($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi.']);
        }

        Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ],
            [
                'quantity' => $request->quantity,
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, Cart $cart): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        if ($cart->product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi.']);
        }

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui.');
    }

    public function destroy(Cart $cart): RedirectResponse
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}
