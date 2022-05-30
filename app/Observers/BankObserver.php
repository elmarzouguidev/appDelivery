<?php

namespace App\Observers;

use App\Models\Sameleon\Bank;

class BankObserver
{
    /**
     * Handle the Bank "created" event.
     *
     * @param  \App\Models\Sameleon\Bank  $bank
     * @return void
     */
    public function created(Bank $bank)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Bank "updated" event.
     *
     * @param  \App\Models\Sameleon\Bank  $bank
     * @return void
     */
    public function updated(Bank $bank)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Bank "deleted" event.
     *
     * @param  \App\Models\Sameleon\Bank  $bank
     * @return void
     */
    public function deleted(Bank $bank)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Bank "restored" event.
     *
     * @param  \App\Models\Sameleon\Bank  $bank
     * @return void
     */
    public function restored(Bank $bank)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Bank "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Bank  $bank
     * @return void
     */
    public function forceDeleted(Bank $bank)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {
        cache()->pull('all_banks_cache');
    }
}
