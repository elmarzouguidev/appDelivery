<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Invoice;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class InvoiceOfDay
{
    protected CacheManager $cache;

    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $invoice = $this->invoice = Invoice::whereDay('created_at', now()->format('d'))

            ->first();

        $view->with('invoice_of_day', $invoice);
    }
}
