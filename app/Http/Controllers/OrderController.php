<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with(['items.productVariant.product', 'payment'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $order->load(['items.productVariant.product.images', 'items.productVariant.product.brand', 'address', 'payment']);

        return view('orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        $this->authorize('update', $order);

        if (!$order->isCancelable()) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        // Restore stock
        foreach ($order->items as $item) {
            $item->productVariant->increment('stock', $item->quantity);
        }

        $order->update(['status' => 'canceled']);

        if ($order->payment) {
            $order->payment->update(['status' => 'failed']);
        }

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
