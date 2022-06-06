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
        $this->clearAllCache($product);
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Sameleon\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $this->clearAllCache($product);
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Sameleon\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $this->clearAllCache($product);
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Sameleon\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        $this->clearAllCache($product);
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        $this->clearAllCache($product);
    }

    private function clearAllCache($product)
    {

        if (auth()->user()->hasRole('Client')) {
            $cacheKey = "all_products_cache_" . $product->client->uuid;
            cache()->pull($cacheKey);
            cache()->pull('all_products_cache');
        } else {
            cache()->pull('all_products_cache');
        }
    }
}
