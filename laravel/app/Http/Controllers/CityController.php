<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityCollection;
use App\UseCase\City\ListCityAction;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function list(Request $request, string $prefectureCode, ListCityAction $action)
    {
        return new CityCollection($action($prefectureCode));
    }
}
