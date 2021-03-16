<?php

namespace App\Models;

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
}
