<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $code 都道府県コード(2桁)
 */
class Prefecture extends EloquentModelBase
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'prefecture_name',
        'prefecture_kana',
        'prefecture_roma',
    ];
}
