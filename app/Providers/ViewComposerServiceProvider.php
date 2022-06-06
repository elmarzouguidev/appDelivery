<?php

namespace App\Providers;

use App\Http\View\Composers\CommandComposer;
use App\Http\View\Composers\DeliveryComposer;
use App\Http\View\Composers\InvoiceOfDay;
use App\Http\View\Composers\NavBarComposer;
use App\Http\View\Composers\RamassageComposer;
use App\Http\View\Composers\StockComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
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
        View::composer(['Sameleon.Admin.Home.*'], CommandComposer::class);
        //View::composer(['Sameleon.Admin.Home.*'], DeliveryComposer::class);

        View::composer(['livewire.sameleon.command.*'], InvoiceOfDay::class);

        View::composer(['layouts._parts.__sameleon_admin'], NavBarComposer::class);

        View::composer(['layouts._parts.__sameleon_admin'], StockComposer::class);

        View::composer(['layouts._parts.__sameleon_admin'], RamassageComposer::class);
    }
}
