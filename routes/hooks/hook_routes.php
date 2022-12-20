<?php

use App\Http\Controllers\Hooks\HooksController;
use App\Repositories\Source\SourceInterface;
use Illuminate\Support\Facades\Route;

$sourceRoutes = app(SourceInterface::class)->getSources();

if (isset($sourceRoutes) && count($sourceRoutes) > 0) {
    foreach ($sourceRoutes as $sourceRoute) {
        Route::post($sourceRoute->route, [HooksController::class, $sourceRoute->platform])->name($sourceRoute->route_name);
    }
}
