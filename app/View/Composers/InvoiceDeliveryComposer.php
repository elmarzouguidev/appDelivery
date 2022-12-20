<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\DeliveryInvoice;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class InvoiceDeliveryComposer
{
    protected DeliveryInvoice $deliveryInvoice;

    protected CacheManager $cache;

    public function __construct(DeliveryInvoice $deliveryInvoice, CacheManager $cache)
    {
        $this->deliveryInvoice = $deliveryInvoice;

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
        $view->with('delivery_total_chiffre_affaires_non_versed', $this->deliveryInvoice->totalChiffreNonVersed());
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
