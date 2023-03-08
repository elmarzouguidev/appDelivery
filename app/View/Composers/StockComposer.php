<?php

namespace App\View\Composers;

use App\Models\Sameleon\Stock;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class StockComposer
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
        if (isClient()) {
            $stock = Stock::where('client_id', auth()->id())
                ->where('client_uuid', auth()->user()->uuid)
                //->whereIsOut(true)
                //->where('qte_rest', '<=', 5)
                ->whereColumn('qte_rest', 'qte_alert')
                //->whereIsDefault(true)
                ->count();
        } elseif (isAdmin()) {
            $stock = Stock::whereColumn('qte_rest', 'qte_alert')
                ->count();
        } elseif (isDelivery()) {
            $stock = Stock::whereIsDefault(false)
                ->whereDeliveryId(delivery()->id)
                ->whereDeliveryUuid(delivery()->uuid)
                ->whereColumn('qte_rest', 'qte_alert')
                //->whereIsOut(true)
                ->count();
        } else {
            $stock = null;
        }

        $view->with('stock_out', $stock);
    }
}
