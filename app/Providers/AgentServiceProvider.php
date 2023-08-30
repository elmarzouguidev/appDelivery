<?php

namespace App\Providers;

use App\View\Composers\AgentComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AgentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['Sameleon.*', 'layouts.*'], AgentComposer::class);
    }
}
