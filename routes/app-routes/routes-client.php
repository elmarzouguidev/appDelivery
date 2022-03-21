<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sameleon\Client\ClientHomeController;
use App\Http\Controllers\Sameleon\Client\Product\ClientProductController;
use App\Http\Controllers\Sameleon\Client\Command\ClientCommandController;
use App\Http\Controllers\Sameleon\Client\Company\ClientCompanyController;

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

Route::group(['prefix' => 'settings'], function () {

    Route::group(['prefix' => 'company'], function () {

        Route::get('/', [ClientCompanyController::class, 'index'])->name('company');
        Route::post('/', [ClientCompanyController::class, 'store'])->name('company.store');
    });
});
