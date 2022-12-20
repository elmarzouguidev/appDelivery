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
        $this->clearAllCache();
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {
        cache()->pull('all_clients_cache');

        cache()->pull('all_admins_cache');

        cache()->pull('all_deliveries_cache');
    }
}
