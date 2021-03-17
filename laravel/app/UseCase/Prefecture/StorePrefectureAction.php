<?php
namespace App\UseCase\Prefecture;

use App\Models\Prefecture;

class StorePrefectureAction
{
    public function handle(Prefecture $prefecture): Prefecture
    {
        return $prefecture->firstOrCreate(['code' => $prefecture->code], $prefecture->toArray());
    }
}
