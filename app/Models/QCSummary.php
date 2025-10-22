<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QCSummary extends Model
{
    protected $fillable = [
        'article_id',
        'date',
        'process',
        'qty',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
