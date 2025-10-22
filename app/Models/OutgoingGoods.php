<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutgoingGoods extends Model
{
    protected $fillable = [
        'po_id',
        'brand_id',
        'article_id',
        'color_id',
        'size_id',
        'incoming_id',
        'qty',
        'date',
        'status',
        'created_by',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
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

    public function incomingGoods(): BelongsTo
    {
        return $this->belongsTo(IncomingGoods::class, 'incoming_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'po_id');
    }
}
