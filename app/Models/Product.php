<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'slug',
        'description',
        'base_price',
        'is_active',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:2',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function primaryImage(): ?ProductImage
    {
        return $this->images()->first();
    }

    public function primaryImageUrl(): string
    {
        $image = $this->primaryImage();
        return $image ? $image->image_url : 'https://picsum.photos/seed/' . $this->slug . '/400/500';
    }

    public function availableColors(): array
    {
        return $this->variants()->distinct()->pluck('color')->toArray();
    }

    public function availableSizes(): array
    {
        return $this->variants()->distinct()->pluck('size')->toArray();
    }

    public function totalStock(): int
    {
        return $this->variants()->sum('stock');
    }

    public function formattedPrice(): string
    {
        return 'Rp ' . number_format($this->base_price, 0, ',', '.');
    }

    public function isNew(): bool
    {
        return $this->created_at->diffInDays(now()) <= 14;
    }
}
