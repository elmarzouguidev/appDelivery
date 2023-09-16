<?php

namespace App\View\Composers;

use App\Models\Sameleon\Bill;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class PaymentComposer
{
    protected Bill $bill;

    protected CacheManager $cache;

    public function __construct(Bill $bill, CacheManager $cache)
    {
        $this->bill = $bill;

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
        $view->with('payments', $this->bill->totalCommands());

        /*$view->with('categoriesMenu', $this->cache->remember('categoriesMenu', $this->timeToLive(), function () {
             return $this->categories->categoryInMenu();
         })); */
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
