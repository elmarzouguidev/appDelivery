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
        if (auth()->user()->hasRole('Client')) {
            $stock =  Product::where('user_id', auth()->id())
                ->whereOutOfStock()->count();
        } elseif (auth()->user()->hasAnyRole('Admin', 'SuperAdmin')) {
            $stock =   Product::whereOutOfStock()->count();
        } else {
            $stock = null;
        }

        $view->with('stock_out', $stock);
    }
}
