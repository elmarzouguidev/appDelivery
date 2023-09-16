<?php

namespace App\View\Composers;

use App\Models\Sameleon\Invoice;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class InvoiceComposer
{
    protected Invoice $invoice;

    protected CacheManager $cache;

    public function __construct(Invoice $invoice, CacheManager $cache)
    {
        $this->invoice = $invoice;

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
        $view->with('total_chiffre_affaires_non_versed', $this->invoice->totalChiffreNonVersed());
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
