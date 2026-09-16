<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'order_number',
        'status',
        'total_amount',
        'shipping_cost',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function grandTotal(): float
    {
        return $this->total_amount + $this->shipping_cost;
    }

    public function formattedGrandTotal(): string
    {
        return 'Rp ' . number_format($this->grandTotal(), 0, ',', '.');
    }

    public function formattedTotalAmount(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function formattedShippingCost(): string
    {
        return 'Rp ' . number_format($this->shipping_cost, 0, ',', '.');
    }

    public function isCancelable(): bool
    {
        return $this->status === 'pending_payment';
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'pending_payment' => 'Menunggu Pembayaran',
            'paid' => 'Dibayar',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Selesai',
            'canceled' => 'Dibatalkan',
            default => $this->status,
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'pending_payment' => 'amber',
            'paid' => 'blue',
            'processing' => 'indigo',
            'shipped' => 'purple',
            'delivered' => 'emerald',
            'canceled' => 'red',
            default => 'gray',
        };
    }

    public static function generateOrderNumber(): string
    {
        $date = now()->format('Ymd');
        $lastOrder = static::whereDate('created_at', today())->latest('id')->first();
        $sequence = $lastOrder ? (int) substr($lastOrder->order_number, -3) + 1 : 1;

        return 'INV-' . $date . '-' . str_pad($sequence, 3, '0', STR_PAD_LEFT);
    }
}
