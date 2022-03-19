<?php

use App\Http\Controllers\Sameleon\Admin\Admin\AdminController;
use App\Http\Controllers\Sameleon\Admin\AdminHomeController;
use App\Http\Controllers\Sameleon\Admin\City\AdminCityController;
use App\Http\Controllers\Sameleon\Admin\Client\ClientController;
use App\Http\Controllers\Sameleon\Admin\Command\AdminCommandController;
use App\Http\Controllers\Sameleon\Admin\Product\AdminProductController;
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

Route::group(['prefix' => 'products'], function () {

    Route::get('/', [AdminProductController::class, 'index'])->name('products.index');

    Route::get('/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/create', [AdminProductController::class, 'store'])->name('products.store');

    Route::delete('/', [AdminProductController::class, 'delete'])->name('products.delete');
});



Route::group(['prefix' => 'cities'], function () {

    Route::get('/', [AdminCityController::class, 'index'])->name('cities.index');

    Route::post('/', [AdminCityController::class, 'store'])->name('cities.store');

    Route::delete('/', [AdminCityController::class, 'delete'])->name('cities.delete');
});

Route::group(['prefix' => 'clients'], function () {

    Route::get('/', [ClientController::class, 'index'])->name('clients.index');

    Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/create', [ClientController::class, 'store'])->name('clients.store');

    Route::delete('/', [ClientController::class, 'delete'])->name('clients.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{client}', [ClientController::class, 'edit'])->name('clients.edit');
        Route::post('/{client}', [ClientController::class, 'update'])->name('clients.update');
    });
});

Route::group(['prefix' => 'auth/admins'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admins.index');

    Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/create', [AdminController::class, 'store'])->name('admins.store');

    Route::delete('/', [AdminController::class, 'delete'])->name('admins.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{user}', [AdminController::class, 'edit'])->name('admins.edit');
        Route::post('/{user}', [AdminController::class, 'update'])->name('admins.update');
    });
});