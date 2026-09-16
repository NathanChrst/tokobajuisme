<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'price_at_purchase',
    ];

    protected function casts(): array
    {
        return [
            'price_at_purchase' => 'decimal:2',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function subtotal(): float
    {
        return $this->quantity * $this->price_at_purchase;
    }

    public function formattedSubtotal(): string
    {
        return 'Rp ' . number_format($this->subtotal(), 0, ',', '.');
    }

    public function formattedPrice(): string
    {
        return 'Rp ' . number_format($this->price_at_purchase, 0, ',', '.');
    }
}
