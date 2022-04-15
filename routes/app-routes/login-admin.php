<?php

use App\Http\Controllers\Sameleon\Admin\AuthAdminController;
use App\Http\Controllers\Sameleon\Web\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthAdminController::class, 'loginForm'])->name('login');

Route::post('/login', [AuthAdminController::class, 'login'])->middleware('throttle:login')->name('loginPost');

Route::post('/logout', [AuthAdminController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'register', 'middleware' => 'guest'], function () {

    Route::get('/', [RegisterController::class, 'index'])->name('register');
    Route::post('/', [RegisterController::class, 'store'])->name('register.post');

});
