<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'po_number',
        'brand_id',
        'article_id',
        'color_id',
        'size_id',
        'order_date',
        'qty_ordered',
        'status',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function incomingGoods(): HasMany
    {
        return $this->hasMany(IncomingGoods::class, 'po_id');
    }

    public function outgoingGoods(): HasMany
    {
        return $this->hasMany(OutgoingGoods::class, 'po_id');
    }

    /**
     * Get total quantity sent to packing
     */
    public function getQtySentAttribute(): int
    {
        return $this->outgoingGoods()
            ->where('status', 'sent_to_packing')
            ->sum('qty');
    }

    /**
     * Get PO progress percentage (0-100)
     */
    public function getProgressAttribute(): float
    {
        if ($this->qty_ordered == 0) {
            return 0;
        }
        return round(($this->qty_sent / $this->qty_ordered) * 100, 2);
    }

    /**
     * Get auto-calculated status based on outgoing goods
     */
    public function getAutoStatusAttribute(): string
    {
        if ($this->progress >= 100) {
            return 'completed';
        }
        return 'in_progress';
    }

    /**
     * Get remaining quantity to fulfill PO
     */
    public function getQtyRemainingAttribute(): int
    {
        return max(0, $this->qty_ordered - $this->qty_sent);
    }
}
