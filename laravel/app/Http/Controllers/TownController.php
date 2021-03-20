<?php

namespace App\Http\Controllers;

use App\Http\Requests\TownInfoGetRequest;
use App\Http\Resources\TownCollection;
use App\Http\Resources\TownInfoCollection;
use App\UseCase\Town\GetTownInfoAction;
use App\UseCase\Town\ListTownAction;
use Illuminate\Http\Request;

class TownController extends Controller
{
    public function list(Request $request, string $cityCode, ListTownAction $action)
    {
        return new TownCollection($action($cityCode));
    }

    public function getInfo(TownInfoGetRequest $request, GetTownInfoAction $action)
    {
        return new TownInfoCollection($action($request->makeTownCodes()));
    }
}
