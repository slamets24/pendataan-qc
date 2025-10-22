<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = [
        'brand_id',
        'article_name',
        'category',
        'created_date',
    ];

    protected $casts = [
        'created_date' => 'date',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function incomingGoods(): HasMany
    {
        return $this->hasMany(IncomingGoods::class);
    }

    public function qcSummaries(): HasMany
    {
        return $this->hasMany(QCSummary::class);
    }

    public function revisions(): HasMany
    {
        return $this->hasMany(Revision::class);
    }

    public function outgoingGoods(): HasMany
    {
        return $this->hasMany(OutgoingGoods::class);
    }
}
