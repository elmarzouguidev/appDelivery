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

Route::group(['prefix' => 'orders'], function () {

    Route::get('/{command}', [ApiCommandController::class, 'single'])->name('order.single');

    Route::post('/create', [ApiCommandController::class, 'store'])->name('order.store');
});
