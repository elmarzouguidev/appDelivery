<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sameleon\Client\ClientHomeController;
use App\Http\Controllers\Sameleon\Client\Product\ClientProductController;
use App\Http\Controllers\Sameleon\Client\Command\ClientCommandController;

Route::get('/home', [ClientHomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'commands'], function () {

    Route::get('/', [ClientCommandController::class, 'index'])->name('commands.index');
    Route::post('/', [ClientCommandController::class, 'store'])->name('commands.store');
    Route::delete('/delete', [ClientCommandController::class, 'delete'])->name('commands.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{command}', [ClientCommandController::class, 'edit'])->name('commands.edit');
        Route::post('/{command}', [ClientCommandController::class, 'update'])->name('commands.update');
    });
});

Route::group(['prefix' => 'products'], function () {

    Route::get('/', [ClientProductController::class, 'index'])->name('products.index');

    Route::get('/create', [ClientProductController::class, 'create'])->name('products.create');
    Route::post('/create', [ClientProductController::class, 'store'])->name('products.store');

    Route::delete('/delete', [ClientProductController::class, 'delete'])->name('products.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{product}', [ClientProductController::class, 'edit'])->name('products.edit');
        Route::post('/{product}', [ClientProductController::class, 'update'])->name('products.update');
    });
});

/*
Route::group(['prefix' => 'commands'], function () {

    Route::get('/', [CommandController::class, 'index'])->name('commands.index');

    Route::get('/create', [CommandController::class, 'create'])->name('commands.create');
    Route::post('/create', [CommandController::class, 'store'])->name('commands.store');

    Route::delete('/delete', [CommandController::class, 'delete'])->name('commands.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{command}', [CommandController::class, 'edit'])->name('commands.edit');
        Route::post('/{command}', [CommandController::class, 'update'])->name('commands.update');
    });
});


Route::group(['prefix' => 'products'], function () {

    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/create', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/delete', [ProductController::class, 'delete'])->name('products.delete');

    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/edit/{product}', [ProductController::class, 'update'])->name('products.update');
});*/
