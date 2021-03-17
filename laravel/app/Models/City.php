<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 */
class City extends EloquentModelBase
{
    use HasFactory;

    protected $fillable = [
        'id',
        'prefecture_id',
        'city_code',
        'city_name',
        'city_kana',
        'city_roma',
        'valid'
    ];

    ////
    // Relation
    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class);
    }

    ////
    // Query
    public function scopePrefectureCode(Builder $query, string $prefectureCode)
    {
        $query->whereHas('prefecture', function (Builder $q1) use($prefectureCode) {
            $q1->where('code', $prefectureCode);
        });
    }
}
