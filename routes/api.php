<?php

use App\Http\Controllers\Sameleon\API\V1\ApiCommandController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'throttle:30'], function () {
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/track/{command}', [ApiCommandController::class, 'track'])->name('order.track');

        Route::post('/create', [ApiCommandController::class, 'store'])->name('order.store');
    });
});
