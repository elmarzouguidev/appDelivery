<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Sameleon\Product' => 'App\Policies\Sameleon\ProductPolicy',
        'App\Models\Sameleon\Command' => 'App\Policies\Sameleon\CommandPolicy',
        'App\Models\Sameleon\User' => 'App\Policies\Sameleon\UserPolicy',
        'App\Models\Sameleon\Delivery' => 'App\Policies\Sameleon\DeliveryPolicy',
        'App\Models\Sameleon\City' => 'App\Policies\Sameleon\CityPolicy',
        'App\Models\Sameleon\Region' => 'App\Policies\Sameleon\RegionPolicy',
        'App\Models\Sameleon\Stock' => 'App\Policies\Sameleon\StockPolicy',

        'App\Models\Sameleon\Bank' => 'App\Policies\Sameleon\BankPolicy',

        'App\Models\Sameleon\BRouter' => 'App\Policies\Sameleon\BRouterPolicy',
        'App\Models\Sameleon\BLivraison' => 'App\Policies\Sameleon\BLivraisonPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        /*Gate::before(function ($user, $ability) {
            return $user->hasRole('SuperAdmin') ? true : null;
        });*/
    }
}
