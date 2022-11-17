<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{


    protected function redirectTo($request)
    {

        //dd('fezfhhhhhh');
        if (!$request->expectsJson()) {
            if ($request->route()->getName() === "admin:home") {
                return route('admin:auth:login');
            } elseif ($request->route()->getName() === "delivery:home") {

                return route('delivery:auth:login');
            } else {
                return route('admin:auth:login');
            }
        }
    }

    /*protected function unauthenticated($request, array $guards)
    {
        //dd($guards,"d");
        if (! $request->routeIs('checkout') && $request->is('api/', 'api/*')) {

            abort(response()->json([
                'message' => 'Unauthenticated you must be logged in',
            ], 401));
        }
    }*/
}
