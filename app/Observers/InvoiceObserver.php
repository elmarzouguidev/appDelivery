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
        $this->clearAllCache($invoice);
    }

    /**
     * Handle the Invoice "updated" event.
     *
     * @param  \App\Models\Sameleon\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {
        $this->clearAllCache($invoice);
    }

    /**
     * Handle the Invoice "deleted" event.
     *
     * @param  \App\Models\Sameleon\Invoice  $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
        $this->clearAllCache($invoice);
    }

    /**
     * Handle the Invoice "restored" event.
     *
     * @param  \App\Models\Sameleon\Invoice  $invoice
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        $this->clearAllCache($invoice);
    }

    /**
     * Handle the Invoice "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Invoice  $invoice
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        $this->clearAllCache($invoice);
    }

    private function clearAllCache($invoice)
    {
        if ($invoice->client) {
            $cacheKey = 'all_invoices_cache_'.$invoice->client->uuid;
            cache()->pull($cacheKey);
        }

        cache()->pull('all_invoices_cache');
    }
}
