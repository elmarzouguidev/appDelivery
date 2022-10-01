<?php

use App\Http\Controllers\Sameleon\Admin\SubDelivery\Home\HomeSubDeliveryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeSubDeliveryController::class, 'index'])->name('home');
