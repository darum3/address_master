<?php

namespace App\Http\Controllers;

use App\Http\Resources\TownCollection;
use App\UseCase\Town\ListTownAction;
use Illuminate\Http\Request;

class TownController extends Controller
{
    public function list(Request $request, string $cityCode, ListTownAction $action)
    {
        return new TownCollection($action($cityCode));
    }
}
