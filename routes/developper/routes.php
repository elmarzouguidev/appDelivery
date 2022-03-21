<?php

use Spatie\Health\Http\Controllers\HealthCheckResultsController;
use App\Http\Controllers\Developper\DevController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-tables', [DevController::class, 'clearTables'])->name('truncateModels');
Route::get('/link', [DevController::class, 'storageLink']);
Route::get('/unlink', [DevController::class, 'storageUnLink']);

Route::get('/migrate', [DevController::class, 'migrateAll']);
Route::get('/seed', [DevController::class, 'migrateSeed']);

Route::get('/cache', [DevController::class, 'cacheAll']);
Route::get('/clear', [DevController::class, 'cleareAll']);


Route::get('/app-up', [DevController::class, 'appUp']);
Route::get('/app-down', [DevController::class, 'appDown']);

Route::get('/installer', [DevController::class, 'installer']);

Route::get('health', HealthCheckResultsController::class);
