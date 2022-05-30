<?php

namespace App\Observers;

use App\Models\Sameleon\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Sameleon\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Sameleon\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Sameleon\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Sameleon\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {

        if (auth()->user()->hasRole('Client')) {
            $cacheKey = "all_products_cache_" . auth()->user()->uuid;
            cache()->pull($cacheKey);
            cache()->pull('all_products_cache');
        } else {
            cache()->pull('all_products_cache');
        }
    }
}
