<?php

namespace App\Providers;

use App\Models\Sameleon\Bill;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Invoice;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use App\Observers\BillObserver;
use App\Observers\CommandObserver;
use App\Observers\InvoiceObserver;
use App\Observers\ProductObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
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
        User::observe(UserObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Product::observe(ProductObserver::class);
        Bill::observe(BillObserver::class);
        Command::observe(CommandObserver::class);
    }
}
