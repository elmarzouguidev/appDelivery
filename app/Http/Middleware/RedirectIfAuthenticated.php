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
     * @var array|string[]
     */
    private array $actions = ['web' => 'sameleon:home', 'client' => 'client:home'];

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
            if (Auth::guard($guard)->check()) {
                return redirect(route($this->actions[$guard]));
            }
        }

        return $next($request);
    }
}
