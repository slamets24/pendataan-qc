<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function salesChannels(): HasMany
    {
        return $this->hasMany(SalesChannel::class);
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
