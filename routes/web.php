<?php

use App\Http\Controllers\Authentification\ForgotPasswordController;
use App\Http\Controllers\Authentification\ResetPasswordController;
use App\Http\Controllers\Sameleon\Admin\Invoice\InvoiceController;

use Illuminate\Support\Facades\Route;


Route::redirect('/', '/app')->name('home');

Route::group(['prefix' => 'views','middleware'=>'auth'], function () {

    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/invoice/{invoice}', [InvoiceController::class, 'showInvoice'])->name('public.show.invoice');
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
