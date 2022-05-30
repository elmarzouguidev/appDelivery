<?php

namespace App\Observers;

use App\Models\Sameleon\UserBank;

class UserBankObserver
{
    /**
     * Handle the UserBank "created" event.
     *
     * @param  \App\Models\Sameleon\UserBank  $userBank
     * @return void
     */
    public function created(UserBank $userBank)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the UserBank "updated" event.
     *
     * @param  \App\Models\Sameleon\UserBank  $userBank
     * @return void
     */
    public function updated(UserBank $userBank)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the UserBank "deleted" event.
     *
     * @param  \App\Models\Sameleon\UserBank  $userBank
     * @return void
     */
    public function deleted(UserBank $userBank)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the UserBank "restored" event.
     *
     * @param  \App\Models\Sameleon\UserBank  $userBank
     * @return void
     */
    public function restored(UserBank $userBank)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the UserBank "force deleted" event.
     *
     * @param  \App\Models\Sameleon\UserBank  $userBank
     * @return void
     */
    public function forceDeleted(UserBank $userBank)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {
        //cache()->pull('all_banks_cache');
        cache()->pull('all_clients_cache');
    }
}
