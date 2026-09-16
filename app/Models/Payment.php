<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_method',
        'status',
        'proof_url',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function methodLabel(): string
    {
        return match ($this->payment_method) {
            'transfer_bank' => 'Transfer Bank',
            'gopay' => 'GoPay',
            'kartu_kredit' => 'Kartu Kredit',
            default => $this->payment_method,
        };
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Verifikasi',
            'success' => 'Berhasil',
            'failed' => 'Gagal',
            default => $this->status,
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'pending' => 'amber',
            'success' => 'emerald',
            'failed' => 'red',
            default => 'gray',
        };
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}

