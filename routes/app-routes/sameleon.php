<?php

use App\Http\Controllers\Sameleon\CommandController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'],function(){

    Route::get('/',[CommandController::class, 'index'])->name('orders.index');
});


