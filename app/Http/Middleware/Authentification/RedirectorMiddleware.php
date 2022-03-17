<?php

namespace App\Http\Middleware\Authentification;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class RedirectorMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Application|RedirectResponse|Redirector|mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->is('app', 'app/')) {

            return redirect()->route('home');
        }

        if ($request->is('app/sameleon', 'app/sameleon/')) {

            return redirect()->route('sameleon:home');
        }

        if ($request->is('app/clients', 'app/clients/')) {
            return redirect()->route('client:home');
        }
    }
}
