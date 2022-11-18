<?php

use App\Http\Controllers\Sameleon\Admin\SubDelivery\Command\CommandSubDeliveryController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Delivery\ProfilSubDeliveryController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Delivery\SubDeliveryController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Home\HomeSubDeliveryController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Invoice\InvoiceSubDeliveryController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Payment\PaymentSubDeliveryController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Product\ProductSubDeliveryController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Stock\StockSubDeliveryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeSubDeliveryController::class, 'index'])->name('home');

Route::put('/read-notifications', [HomeSubDeliveryController::class, 'markNotification'])

    ->name('home.read.notifications');

Route::group(['middleware' => ['role:DeliveryEntreprise|SubDelivery|Delivery']], function () {

    Route::group(['prefix' => 'commands'], function () {

        Route::get('/', [CommandSubDeliveryController::class, 'index'])->name('commands.index');

        Route::post('/', [CommandSubDeliveryController::class, 'store'])->name('commands.store');

        Route::delete('/delete', [CommandSubDeliveryController::class, 'delete'])->name('commands.delete');

        Route::post('/import', [CommandSubDeliveryController::class, 'import'])->name('commands.import');
        Route::group(['prefix' => 'edit'], function () {

            Route::get('/{command}', [CommandSubDeliveryController::class, 'edit'])->name('commands.edit');
            Route::post('/{command}', [CommandSubDeliveryController::class, 'update'])->name('commands.update');
        });

        Route::group(['prefix' => 'archived'], function () {

            Route::get('/', [CommandSubDeliveryController::class, 'archived'])->name('commands.archived');
        });
    });
});

Route::group(['middleware' => ['role:DeliveryEntreprise']], function () {

    Route::group(['prefix' => 'products'], function () {

        Route::get('/', [ProductSubDeliveryController::class, 'index'])->name('products.index');

        Route::get('/create', [ProductSubDeliveryController::class, 'create'])->name('products.create');
        Route::post('/create', [ProductSubDeliveryController::class, 'store'])->name('products.store');

        Route::delete('/', [ProductSubDeliveryController::class, 'delete'])->name('products.delete');

        Route::group(['prefix' => 'edit'], function () {

            Route::get('/{product}', [ProductSubDeliveryController::class, 'edit'])->name('products.edit');
            Route::post('/{product}', [ProductSubDeliveryController::class, 'update'])->name('products.update');
        });
    });

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

    Route::group(['prefix' => 'invoices'], function () {

        Route::get('/', [InvoiceSubDeliveryController::class, 'index'])->name('invoices.index');
    });

    Route::group(['prefix' => 'payments'], function () {

        Route::get('/', [PaymentSubDeliveryController::class, 'index'])->name('payments.index');
        Route::delete('/delete', [PaymentSubDeliveryController::class, 'delete'])->name('payments.delete');
    });
});

Route::group(['middleware' => ['role:DeliveryEntreprise|SubDelivery|Delivery']], function () {

    Route::group(['prefix' => 'account'], function () {

        Route::group(['prefix' => 'info'], function () {

            Route::get('/', [ProfilSubDeliveryController::class, 'index'])->name('profil');
            Route::post('/', [ProfilSubDeliveryController::class, 'update'])->name('profil.update');

            Route::post('/password', [ProfilSubDeliveryController::class, 'updatePassword'])->name('profil.update.password');

            Route::post('/company', [ProfilSubDeliveryController::class, 'updateCompany'])->name('profil.update.company');

            Route::post('/bank', [ProfilSubDeliveryController::class, 'updateBank'])->name('profil.update.bank');
        });
    });
});
