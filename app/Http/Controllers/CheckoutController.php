<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()
            ->with(['productVariant.product.images', 'productVariant.product.brand'])
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        $addresses = auth()->user()->addresses;
        $subtotal = $cartItems->sum(fn ($item) => $item->subtotal());

        // Simple shipping cost calculation based on address
        $shippingCost = 15000; // flat rate for now

        return view('checkout.index', compact('cartItems', 'addresses', 'subtotal', 'shippingCost'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|in:transfer_bank,gopay,kartu_kredit',
            'notes' => 'nullable|string|max:500',
        ]);

        $cartItems = auth()->user()->cartItems()
            ->with('productVariant.product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        // Validate stock for all items
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->productVariant->stock) {
                return back()->with('error', "Stok {$item->productVariant->product->name} ({$item->productVariant->label()}) tidak mencukupi.");
            }
        }

        $subtotal = $cartItems->sum(fn ($item) => $item->subtotal());
        $shippingCost = 15000;

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'address_id' => $request->address_id,
            'order_number' => Order::generateOrderNumber(),
            'status' => 'pending_payment',
            'total_amount' => $subtotal,
            'shipping_cost' => $shippingCost,
            'notes' => $request->notes,
        ]);

        // Create order items & decrease stock
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item->product_variant_id,
                'quantity' => $item->quantity,
                'price_at_purchase' => $item->productVariant->product->base_price,
            ]);

            // Decrease stock
            $item->productVariant->decrement('stock', $item->quantity);
        }

        // Create payment record
        $order->payment()->create([
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // Clear cart
        auth()->user()->cartItems()->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }
}

