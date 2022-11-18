<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{


    /**
     * @param Request $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return Application|RedirectResponse|Redirector|mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            /*if (Auth::guard($guard)->check()) {
                if ($guard == "delivery") {
                    return redirect(route('delivery:home'));
                } else {
                    return redirect(route('admin:home'));
                }
            }*/

            if (Auth::guard("delivery")->check()) {
                return redirect(route('delivery:home'));
            }
            if (Auth::guard("web")->check()) {
                return redirect(route('admin:home'));
            }
        }

        return $next($request);
    }
}
