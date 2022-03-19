<?php


use App\Http\Controllers\Sameleon\Admin\Invoice\InvoiceController;

use Illuminate\Support\Facades\Route;

Route::get('/post', [SiteController::class, 'index']);

Route::redirect('/', '/app')->name('home');

Route::group(['prefix' => 'views'], function () {

    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/invoice/{invoice}', [InvoiceController::class, 'showInvoice'])->name('public.show.invoice');
    });
});
