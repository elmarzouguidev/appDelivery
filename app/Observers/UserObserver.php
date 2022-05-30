<?php

namespace App\Observers;

use App\Models\Sameleon\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->clearAllCache($user);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->clearAllCache($user);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->clearAllCache($user);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        $this->clearAllCache($user);
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->clearAllCache($user);
    }

    private function clearAllCache(User $user)
    {
        if ($user->hasRole('Client')) {
            cache()->pull('all_clients_cache');
        }
        if ($user->hasAnyRole('Admin', 'SuperAdmin')) {
            cache()->pull('all_admins_cache');
        }
        if ($user->hasRole('Delivery')) {
            cache()->pull('all_deliveries_cache');
        }
    }
}
