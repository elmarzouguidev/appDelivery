<?php

use App\Repositories\Source\SourceInterface;
use Illuminate\Support\Facades\Route;

$sourceRoutes = app(SourceInterface::class)->getSources();

if (isset($sourceRoutes) && count($sourceRoutes) > 0) {

    foreach ($sourceRoutes as $sourceRoute) {

        Route::webhooks($sourceRoute->route, 'sameleon');
    }
}
