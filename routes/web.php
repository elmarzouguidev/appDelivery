<?php

use App\Http\Controllers\Authentification\ForgotPasswordController;
use App\Http\Controllers\Authentification\ResetPasswordController;
use App\Http\Controllers\Sameleon\Admin\BL\PDFBLController;
use App\Http\Controllers\Sameleon\Admin\BR\PDFBRController;
use App\Http\Controllers\Sameleon\Admin\Invoice\InvoiceController;
use App\Http\Controllers\Sameleon\Admin\Payment\PDFPaymentController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Invoice\InvoiceSubDeliveryPDFController;
use App\Http\Controllers\Sameleon\Admin\SubDelivery\Payment\PaymentSubDeliveryPDFController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/app')->name('home');

Route::redirect('/delivery/', '/delivery/app')->name('deliveryhome');

Route::redirect('/login', '/app/login')->name('login');

Route::group(['prefix' => 'views', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/invoice/{invoice}', [InvoiceController::class, 'showInvoice'])->name('public.show.invoice');
    });

    Route::group(['prefix' => 'bills'], function () {
        Route::get('/bill/{bill}', [PDFPaymentController::class, 'showBill'])->name('public.show.bill');
    });

    Route::group(['prefix' => 'b-livraison'], function () {
        Route::get('/bons/{bon}', [PDFBLController::class, 'showBL'])->name('public.show.bl');
    });

    Route::group(['prefix' => 'b-router'], function () {
        Route::get('/bons/{bon}', [PDFBRController::class, 'showBR'])->name('public.show.br');
    });
});

Route::group(['prefix' => 'views/delivery', 'middleware' => 'auth:delivery,web'], function () {

    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/invoice/{invoice}', [InvoiceSubDeliveryPDFController::class, 'showInvoice'])->name('delivery.public.show.invoice');
    });

    Route::group(['prefix' => 'bills'], function () {
        Route::get('/bill/{bill}', [PaymentSubDeliveryPDFController::class, 'showBill'])->name('delivery.public.show.bill');
    });

    Route::group(['prefix' => 'b-livraison'], function () {
        Route::get('/bons/{bon}', [PDFBLController::class, 'showBL'])->name('delivery.public.show.bl');
    });

    Route::group(['prefix' => 'b-router'], function () {
        Route::get('/bons/{bon}', [PDFBRController::class, 'showBR'])->name('delivery.public.show.br');
    });
});


Route::group(['prefix' => 'app'], function () {

    Route::get('password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->middleware('guest')
        ->name('forgotpassword');

    Route::post('password/request', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->middleware('guest')
        ->name('forgotpasswordPost');

    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/password/reset/', [ResetPasswordController::class, 'reset'])
        ->middleware('guest')
        ->name('password.update');
});
