<?php
namespace App\UseCase\City;

use App\Models\City;
use Illuminate\Support\Collection;

class ListCityAction
{
    public function __invoke(string $prefectureCode): Collection
    {
        return City::prefectureCode($prefectureCode)->get();
    }
}
