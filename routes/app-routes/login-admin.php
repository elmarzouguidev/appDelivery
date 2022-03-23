<?php


use App\Http\Controllers\Sameleon\Admin\AuthAdminController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthAdminController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthAdminController::class, 'login'])->middleware('throttle:login')->name('loginPost');

Route::post('/logout', [AuthAdminController::class, 'logout'])->name('logout');
