<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::where('is_active', true)->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending_payment')->count(),
            'total_revenue' => Order::whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])->sum('total_amount'),
            'total_customers' => User::where('role', 'customer')->count(),
            'pending_payments' => Payment::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with(['user', 'payment'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}

