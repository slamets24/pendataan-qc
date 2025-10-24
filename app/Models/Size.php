<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    protected $fillable = [
        'code',
    ];

    /**
     * Accessor to allow using $size->name instead of $size->code
     */
    public function getNameAttribute()
    {
        return $this->code;
    }

    public function incomingGoods(): HasMany
    {
        return $this->hasMany(IncomingGoods::class);
    }

    public function revisions(): HasMany
    {
        return $this->hasMany(Revision::class);
    }
}
