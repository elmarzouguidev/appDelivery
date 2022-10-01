<?php

use App\Http\Controllers\Sameleon\Admin\SubDelivery\Auth\AuthSubDeliveryController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthSubDeliveryController::class, 'loginForm'])->name('login');

Route::post('/login', [AuthSubDeliveryController::class, 'login'])->middleware('throttle:login')->name('loginPost');

Route::post('/logout', [AuthSubDeliveryController::class, 'logout'])->name('logout');
