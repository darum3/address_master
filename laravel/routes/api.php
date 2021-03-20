<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\PrefectureController;
use App\Http\Controllers\TownController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/prefectures', [PrefectureController::class, 'list']);
Route::get('/cities/{prefcetureCode}', [CityController::class, 'list'])
    ->where('prefectureCode', '[0-9][0-9]');
Route::get('/towns/{cityCode}', [TownController::class, 'list'])
    ->where('cityCode', '[0-9]{5}');
Route::get('/town', [TownController::class, 'getInfo']);
