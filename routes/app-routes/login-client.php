<?php

use App\Http\Controllers\Sameleon\Client\AuthClientController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthClientController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthClientController::class, 'login'])->middleware('throttle:login')->name('loginPost');

Route::post('/logout', [AuthClientController::class, 'logout'])->name('logout');

