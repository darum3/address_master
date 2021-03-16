<?php
namespace App\Models;

use App\Events\CommonSavingEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Exception;

abstract class EloquentModelBase extends Model
{
    protected $dispatchesEvents = [
        'saving' => CommonSavingEvent::class,
    ];

    public static function create(array $params): self
    {
        $instance = new static();

        foreach($params as $key => $value) {
            if (!in_array($key, $instance->fillable)) {
                throw new Exception("{$key} not fillable");
            }

            $instance->{$key} = $value;
        }

        return $instance;
    }
}
