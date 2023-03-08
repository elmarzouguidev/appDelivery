<?php

namespace App\View\Composers;

use App\Models\Sameleon\Product;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class NewProductsComposer
{
    protected Product $product;

    protected CacheManager $cache;

    public function __construct(Product $product, CacheManager $cache)
    {
        $this->product = $product;

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
        $view->with('new_products', $this->product->newProducts());
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
