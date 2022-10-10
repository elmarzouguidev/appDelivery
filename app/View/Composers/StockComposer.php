<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Product;
use App\Models\Sameleon\Stock;
use Illuminate\View\View;
use Illuminate\Cache\CacheManager;


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
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (isClient()) {
            $stock =  Stock::where('client_id', auth()->id())
                ->where('client_uuid', auth()->user()->uuid)
                ->whereIsOut(true)
                ->whereIsDefault(false)
                ->count();
        } elseif (isAdmin()) {
            $stock =   Stock::whereIsDefault(true)
                ->whereIsOut(true)
                ->count();
        } else {
            $stock = null;
        }

        $view->with('stock_out', $stock);
    }
}
