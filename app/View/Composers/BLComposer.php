<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\BLivraison;
use Illuminate\View\View;
use Illuminate\Cache\CacheManager;

class BLComposer
{

    protected BLivraison $bl;

    protected CacheManager $cache;

    public function __construct(BLivraison $bl, CacheManager $cache)
    {
        $this->bl = $bl;

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
        $view->with('total_bls', $this->bl->totalBL());
    }
    

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
