<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariantSize extends Model
{
    protected $fillable = ['variant_id', 'size_name', 'stock_qty', 'reserved_qty'];
    public function variant(): BelongsTo { return $this->belongsTo(ProductVariant::class, 'variant_id'); }

    public function getAvailableQtyAttribute(): int
    {
        return max(0, $this->stock_qty - $this->reserved_qty);
    }
}
