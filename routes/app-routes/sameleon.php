<?php

use App\Http\Controllers\Sameleon\Client\Product\ProductController;
use App\Http\Controllers\Sameleon\CommandController;
use Illuminate\Support\Facades\Route;

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
});
