<?php

namespace App\Observers;

use App\Models\Sameleon\Invoice;

class InvoiceObserver
{
    /**
     * Handle the Invoice "created" event.
     *
     * @param  \App\Models\Sameleon\Invoice  $invoice
     * @return void
     */
    public function created(Invoice $invoice)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Invoice "updated" event.
     *
     * @param  \App\Models\Sameleon\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Invoice "deleted" event.
     *
     * @param  \App\Models\Sameleon\Invoice  $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Invoice "restored" event.
     *
     * @param  \App\Models\Sameleon\Invoice  $invoice
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Invoice "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Invoice  $invoice
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {
        if (auth()->user()->hasRole('Client')) {
            $cacheKey = "all_invoices_cache_" . auth()->user()->uuid;
            cache()->pull($cacheKey);
            //cache()->pull('all_invoices_cache');
        } else {
            cache()->pull('all_invoices_cache');
        }
    }
}
