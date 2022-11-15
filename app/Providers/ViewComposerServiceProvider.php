<?php

namespace App\Providers;

use App\Http\View\Composers\AnnonceComposer;
use App\Http\View\Composers\BillComposer;
use App\Http\View\Composers\CommandComposer;
use App\Http\View\Composers\ConditionComposer;
use App\Http\View\Composers\DeliveryComposer;
use App\Http\View\Composers\InvoiceComposer;
use App\Http\View\Composers\InvoiceDeliveryComposer;
use App\Http\View\Composers\InvoiceOfDay;
use App\Http\View\Composers\NavBarComposer;
use App\Http\View\Composers\NewProductsComposer;
use App\Http\View\Composers\NewUserComposer;
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
        View::composer([
            'Sameleon.Admin.Home2.*',
            'Sameleon.Admin.SubDelivery.Home2.*',
        ], CommandComposer::class);

        View::composer([
            'Sameleon.Admin.Home2.*',
            'Sameleon.Admin.SubDelivery.Home2.*',
        ], BillComposer::class);

        View::composer([
            'Sameleon.Admin.Home2.*',
        ], InvoiceComposer::class);

        View::composer([
            'Sameleon.Admin.SubDelivery.Home2.*',
        ], InvoiceDeliveryComposer::class);
        
        View::composer([
            'Sameleon.Admin.Home2.*',
            'Sameleon.Admin.SubDelivery.Home2.*'
        ], AnnonceComposer::class);

        View::composer([
            'Sameleon.Admin.Product.*',
        ], ConditionComposer::class);
        
        //View::composer(['Sameleon.Admin.Home.*'], DeliveryComposer::class);

        //View::composer(['livewire.sameleon.command.*'], InvoiceOfDay::class);

        View::composer(['layouts._parts.__sameleon_admin'], NewProductsComposer::class);

        View::composer(['layouts._parts.__sameleon_admin'], NewUserComposer::class);

        View::composer([
            'layouts._parts.__sameleon_admin',
            'layouts._parts.__sameleon_delivery_navbar'
        ], NavBarComposer::class);

        View::composer([
            'layouts._parts.__sameleon_admin',
            'layouts._parts.__sameleon_delivery_navbar'
        ], StockComposer::class);


        /****** update abdo */
        View::composer(['layouts._parts.__sameleon_admin'], RamassageComposer::class);
    }
}
