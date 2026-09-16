<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function upload(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('proof')->store('payment-proofs', 'public');

        $order->payment->update([
            'proof_url' => '/storage/' . $path,
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }
}

