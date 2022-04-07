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
        'App\Models\Sameleon\City' => 'App\Policies\Sameleon\CityPolicy',
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
