<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function checkout(): View
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            abort(404);
        }

        $total = $cartItems->sum(fn ($item) => $item->product->price * $item->quantity);

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->withErrors(['cart' => 'Keranjang belanja kosong.']);
        }

        $total = $cartItems->sum(fn ($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total' => $total,
        ]);

        foreach ($cartItems as $item) {
            $item->product->decrement('stock', $item->quantity);

            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            $item->delete();
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }
}
