<?php

namespace App\Models;

use App\Models\City;
use App\Models\EloquentModelBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 */
class Town extends EloquentModelBase
{
    use HasFactory;

    protected $fillable = [
        'id',
        'prefecture_id',
        'city_id',
        'town_code',
        'town_name',
        'town_kana',
        'town_roma',
        'valid'
    ];

    ////
    // Relation
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    ////
    // Query
    public function scopeCityCode(Builder $query, string $cityCode)
    {
        $query->whereHas('city', function (Builder $q1) use ($cityCode) {
            $q1->where('city_code', $cityCode);
        });
    }
}
