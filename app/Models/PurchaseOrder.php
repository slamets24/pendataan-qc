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
        'po_date',
        'qty',
    ];

    protected $casts = [
        'po_date' => 'date',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function incomingGoods(): HasMany
    {
        return $this->hasMany(IncomingGoods::class, 'po_id');
    }
}
