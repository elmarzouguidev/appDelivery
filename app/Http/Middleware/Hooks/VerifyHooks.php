<?php

namespace App\Http\Middleware\Hooks;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyHooks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {

        $method =  substr($request->route()->action['uses'], strpos($request->route()->action['uses'], "@") + 1);

        if (!in_array($method, config('Hooks.allowed'))) {

            return response()->json(['message' => 'sorry this url in not match']);
        }

        if ($method === 'woocommerce') {

            return app(VerifyWoocommerceMiddleware::class)->handle($request, function ($request) use ($next) {

                if ($request) {
                   // dd($request);
                }
                return $next($request);
            });
        }
        return $next($request);
    }
}
