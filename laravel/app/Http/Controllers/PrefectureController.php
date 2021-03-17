<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrefectureCollection;
use App\UseCase\Prefecture\ListPrefectureAction;

class PrefectureController extends Controller
{
    public function list(ListPrefectureAction $action)
    {
        return new PrefectureCollection($action());
    }
}
