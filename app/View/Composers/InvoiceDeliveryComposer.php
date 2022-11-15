<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\DeliveryInvoice;
use Illuminate\View\View;
use Illuminate\Cache\CacheManager;

class InvoiceDeliveryComposer
{

    protected DeliveryInvoice $invoice;

    protected CacheManager $cache;

    public function __construct(DeliveryInvoice $invoice, CacheManager $cache)
    {
        $this->invoice = $invoice;

        $this->cache = $cache;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
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
