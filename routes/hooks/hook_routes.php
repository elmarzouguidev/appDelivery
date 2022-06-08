<?php

use App\Repositories\Source\SourceInterface;
use Illuminate\Support\Facades\Route;

$sourceRoutes = app(SourceInterface::class)->getSources();

if (isset($sourceRoutes) && count($sourceRoutes) > 0) {

    foreach ($sourceRoutes as $sourceRoute) {

        $routeName = "sameleon" . $sourceRoute->id;
        Route::webhooks($sourceRoute->route, "sameleonHooks");
    }
}

//Route::webhooks("sameleonHooks/green-358243ae-cff5-4d91-8573-6c674f65ddf8", "webhook");
