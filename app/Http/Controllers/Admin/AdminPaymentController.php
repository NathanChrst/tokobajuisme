<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['order.user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(15)->withQueryString();

        return view('admin.payments.index', compact('payments'));
    }

    public function approve(Payment $payment)
    {
        if (!$payment->isPending()) {
            return back()->with('error', 'Pembayaran sudah diverifikasi sebelumnya.');
        }

        $payment->update(['status' => 'success']);
        $payment->order->update(['status' => 'paid']);

        return back()->with('success', 'Pembayaran berhasil diverifikasi. Status pesanan diperbarui ke "Dibayar".');
    }

    public function reject(Payment $payment)
    {
        if (!$payment->isPending()) {
            return back()->with('error', 'Pembayaran sudah diverifikasi sebelumnya.');
        }

        $payment->update(['status' => 'failed']);

        return back()->with('success', 'Pembayaran ditolak.');
    }
}

