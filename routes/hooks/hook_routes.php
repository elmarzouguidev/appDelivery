<?php

use App\Repositories\Source\SourceInterface;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

$sourceRoutes = app(SourceInterface::class)->getSources();

if (isset($sourceRoutes) && count($sourceRoutes) > 0) {

    foreach ($sourceRoutes as $sourceRoute) {

        $routeName = "sameleon" . $sourceRoute->id;
        Route::webhooks($sourceRoute->route, "sameleonHooks");
    }
}

//Route::webhooks("sameleonHooks/green-358243ae-cff5-4d91-8573-6c674f65ddf8", "webhook");

/*Route::post('sameleonHooks/x-wc-alpha-green-bc5725e8-f370-4495-860e-714d58e311d8/0111087f-7374-4f16-9bc7-ba07ef135ec6',function(Request $request){
    
    logger($request->all(),$request->header());
})->middleware('woocommerce');*/