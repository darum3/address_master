<?php
namespace App\UseCase\Town;

use App\Models\Town;
use Illuminate\Support\Collection;

class ListTownAction
{
    public function __invoke(string $cityCode): Collection
    {
        return Town::cityCode($cityCode)->get();
    }
}
