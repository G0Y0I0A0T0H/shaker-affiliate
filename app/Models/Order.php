<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public const STATUSES = ['new', 'contacted', 'sold', 'not_sold', 'returned', 'exchange'];

    protected $fillable = [
        'affiliate_id', 'status', 'customer_name', 'customer_phone', 'customer_address',
        'customer_notes', 'total_amount', 'commission_amount', 'status_changed_at'
    ];

    public function affiliate(): BelongsTo { return $this->belongsTo(User::class, 'affiliate_id'); }
    public function items(): HasMany { return $this->hasMany(OrderItem::class); }
}
