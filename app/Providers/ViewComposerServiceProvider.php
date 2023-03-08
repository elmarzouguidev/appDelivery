<?php

namespace App\Providers;

use App\View\Composers\AnnonceComposer;
use App\View\Composers\BillComposer;
use App\View\Composers\BLComposer;
use App\View\Composers\BRComposer;
use App\View\Composers\CommandComposer;
use App\View\Composers\ConditionComposer;
use App\View\Composers\DeliveryComposer;
use App\View\Composers\InvoiceComposer;
use App\View\Composers\InvoiceDeliveryComposer;
use App\View\Composers\InvoiceOfDay;
use App\View\Composers\NavBarComposer;
use App\View\Composers\NavBarDeliveryComposer;
use App\View\Composers\NewProductsComposer;
use App\View\Composers\NewUserComposer;
use App\View\Composers\RamassageComposer;
use App\View\Composers\StockComposer;
use App\View\Composers\SubDeliveryComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
            'Sameleon.Admin.SubDelivery.Home2SubDelivery.*',
        ], SubDeliveryComposer::class);

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
            'Sameleon.Admin.SubDelivery.Home2.*',
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
            'layouts._parts.__sameleon_delivery_navbar',
        ], NavBarComposer::class);

        View::composer([
            'layouts._parts.__sameleon_sub_delivery_navbar',
        ], NavBarDeliveryComposer::class);

        View::composer([
            'layouts._parts.__sameleon_admin',
        ], BRComposer::class);

        View::composer([
            'layouts._parts.__sameleon_admin',
            'layouts._parts.__sameleon_delivery_navbar',
        ], BLComposer::class);

        View::composer([
            'layouts._parts.__sameleon_admin',
            'layouts._parts.__sameleon_delivery_navbar',
        ], StockComposer::class);

        /****** update abdo */
        View::composer(['layouts._parts.__sameleon_admin'], RamassageComposer::class);
    }
}
