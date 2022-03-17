<?php

use App\Http\Controllers\Sameleon\Admin\AdminHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[AdminHomeController::class,'index'])->name('home');
