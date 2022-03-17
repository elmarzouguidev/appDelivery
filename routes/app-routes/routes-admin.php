<?php

use App\Http\Controllers\Sameleon\Admin\AdminHomeController;
use App\Http\Controllers\Sameleon\Admin\City\AdminCityController;
use App\Http\Controllers\Sameleon\Admin\Command\AdminCommandController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [AdminHomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'commands'], function () {

    Route::get('/', [AdminCommandController::class, 'index'])->name('commands.index');

    Route::get('/', [AdminCommandController::class, 'index'])->name('commands.index');
    Route::post('/', [AdminCommandController::class, 'store'])->name('commands.store');
    Route::delete('/delete', [AdminCommandController::class, 'delete'])->name('commands.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{command}', [AdminCommandController::class, 'edit'])->name('commands.edit');
        Route::post('/{command}', [AdminCommandController::class, 'update'])->name('commands.update');
    });
});

Route::group(['prefix' => 'cities'], function () {

    Route::get('/', [AdminCityController::class, 'index'])->name('cities.index');

    Route::post('/', [AdminCityController::class, 'store'])->name('cities.store');

    Route::delete('/', [AdminCityController::class, 'delete'])->name('cities.delete');
});
