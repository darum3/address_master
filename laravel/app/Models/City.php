<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
