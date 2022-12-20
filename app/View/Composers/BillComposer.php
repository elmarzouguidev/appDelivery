<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Bill;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class BillComposer
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
        $view->with('total_chiffre_affaires_versed', $this->bill->totalChiffreVersed());
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
