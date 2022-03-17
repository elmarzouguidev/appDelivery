<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{


    protected function redirectTo($request)
    {
        /*if (!$request->expectsJson()) {
            return route('admin:auth:login');
        }*/

        if ($request->is('api/', 'api/*')) {
            return abort(response()->json([
                'message' => 'Unauthenticated you must be logged in',
            ], 401));
        }

        $routes  = $request->route()->action['middleware'];
        //dd($routes);

        switch ($routes) {
            case $routes[1] === 'auth:client':
                return  route('client:auth:login');
                break;
            case $routes[1] === 'auth':
                return  route('sameleon:auth:login');
                break;
            default:
                return route('home');
        }
    }

    /*protected function unauthenticated($request, array $guards)
    {
        //dd($guards);
        if (! $request->routeIs('checkout') && $request->is('api/', 'api/*')) {

            abort(response()->json([
                'message' => 'Unauthenticated you must be logged in',
            ], 401));
        }
    }*/
}
