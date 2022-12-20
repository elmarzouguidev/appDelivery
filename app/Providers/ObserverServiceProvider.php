<?php

namespace App\Providers;

use App\Models\Sameleon\Bank;
use App\Models\Sameleon\Bill;
use App\Models\Sameleon\City;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Group;
use App\Models\Sameleon\Invoice;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Region;
use App\Models\Sameleon\Source;
use App\Models\Sameleon\User;
use App\Models\Sameleon\UserBank;
use App\Observers\BankObserver;
use App\Observers\BillObserver;
use App\Observers\CityObserver;
use App\Observers\CommandObserver;
use App\Observers\GroupObserver;
use App\Observers\InvoiceObserver;
use App\Observers\ProductObserver;
use App\Observers\RegionObserver;
use App\Observers\SourceObserver;
use App\Observers\UserBankObserver;
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
        City::observe(CityObserver::class);
        Region::observe(RegionObserver::class);
        Bank::observe(BankObserver::class);
        UserBank::observe(UserBankObserver::class);

        Group::observe(GroupObserver::class);
        Source::observe(SourceObserver::class);
    }
}
