<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = [
        'article_name',
        'category',
        'created_date',
    ];

    protected $casts = [
        'created_date' => 'date',
    ];

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
}
