<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()
            ->with(['productVariant.product.images', 'productVariant.product.brand'])
            ->get();

        $total = $cartItems->sum(fn ($item) => $item->subtotal());

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::findOrFail($request->product_variant_id);

        // Check stock
        if ($request->quantity > $variant->stock) {
            return back()->with('error', 'Stok tidak mencukupi. Tersisa ' . $variant->stock . ' item.');
        }

        // Check if already in cart
        $existingItem = auth()->user()->cartItems()
            ->where('product_variant_id', $variant->id)
            ->first();

        if ($existingItem) {
            $newQty = $existingItem->quantity + $request->quantity;
            if ($newQty > $variant->stock) {
                return back()->with('error', 'Total kuantitas melebihi stok yang tersedia.');
            }
            $existingItem->update(['quantity' => $newQty]);
        } else {
            auth()->user()->cartItems()->create([
                'product_variant_id' => $variant->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorize('update', $cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = $cartItem->productVariant;
        if ($request->quantity > $variant->stock) {
            return back()->with('error', 'Stok tidak mencukupi. Tersisa ' . $variant->stock . ' item.');
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);

        $cartItem->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
