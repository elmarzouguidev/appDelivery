<?php

use App\Http\Controllers\Sameleon\Admin\SubDelivery\Delivery\SubDeliveryController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Home\HomeSubDeliveryController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Stock\StockSubDeliveryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeSubDeliveryController::class, 'index'])->name('home');

Route::group(['prefix' => 'stock'], function () {

    Route::get('/', [StockSubDeliveryController::class, 'index'])->name('stock.index');
    Route::post('/', [StockSubDeliveryController::class, 'store'])->name('stock.store');
    Route::post('update/{stock}', [StockSubDeliveryController::class, 'update'])->name('stock.update');
    Route::delete('/delete', [StockSubDeliveryController::class, 'delete'])->name('stock.deletee');

});


Route::group(['prefix' => 'drivers'], function () {

    Route::get('/', [SubDeliveryController::class, 'index'])->name('delivery.index');

    Route::get('/create', [SubDeliveryController::class, 'create'])->name('delivery.create');
    Route::post('/create', [SubDeliveryController::class, 'store'])->name('delivery.store');

    Route::delete('/', [SubDeliveryController::class, 'delete'])->name('delivery.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{delivery}', [SubDeliveryController::class, 'edit'])->name('delivery.edit');
        Route::post('/{delivery}', [SubDeliveryController::class, 'update'])->name('delivery.update');
    });
});