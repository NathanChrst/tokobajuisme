<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        $orders = $query->latest()->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.productVariant.product.images', 'address', 'payment']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending_payment,paid,processing,shipped,delivered,canceled',
        ]);

        $allowedTransitions = [
            'pending_payment' => ['paid', 'canceled'],
            'paid' => ['processing', 'canceled'],
            'processing' => ['shipped', 'canceled'],
            'shipped' => ['delivered'],
            'delivered' => [],
            'canceled' => [],
        ];

        if (!in_array($request->status, $allowedTransitions[$order->status] ?? [])) {
            return back()->with('error', 'Transisi status tidak valid.');
        }

        if ($request->status === 'canceled') {
            foreach ($order->items as $item) {
                $item->productVariant->increment('stock', $item->quantity);
            }
        }

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

