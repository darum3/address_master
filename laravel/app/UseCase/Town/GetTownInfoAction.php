<?php

namespace App\UseCase\Town;

use App\Models\Town;
use Illuminate\Support\Collection;

class GetTownInfoAction
{
    public function __invoke(array $townCodes): Collection
    {
        return Town::whereIn('town_code', $townCodes)
            ->with(['city', 'city.prefecture'])
            ->get();
    }
}
