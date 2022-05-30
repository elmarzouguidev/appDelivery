<?php

namespace App\Observers;

use App\Models\Sameleon\Bill;

class BillObserver
{
    /**
     * Handle the Bill "created" event.
     *
     * @param  \App\Models\Sameleon\Bill  $bill
     * @return void
     */
    public function created(Bill $bill)
    {
        $this->clearAllCachedBills();
    }

    /**
     * Handle the Bill "updated" event.
     *
     * @param  \App\Models\Sameleon\Bill  $bill
     * @return void
     */
    public function updated(Bill $bill)
    {
        $this->clearAllCachedBills();
    }

    /**
     * Handle the Bill "deleted" event.
     *
     * @param  \App\Models\Sameleon\Bill  $bill
     * @return void
     */
    public function deleted(Bill $bill)
    {
        $this->clearAllCachedBills();
    }

    /**
     * Handle the Bill "restored" event.
     *
     * @param  \App\Models\Sameleon\Bill  $bill
     * @return void
     */
    public function restored(Bill $bill)
    {
        $this->clearAllCachedBills();
    }

    /**
     * Handle the Bill "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Bill  $bill
     * @return void
     */
    public function forceDeleted(Bill $bill)
    {
        $this->clearAllCachedBills();
    }

    private function clearAllCachedBills()
    {
        if (auth()->user()->hasRole('Client')) {

            $cacheKey = "all_bills_cache_" . auth()->user()->uuid;

            cache()->pull($cacheKey);
            cache()->pull('all_bills_cache');
        } else {

            cache()->pull('all_bills_cache');
        }
    }
}
