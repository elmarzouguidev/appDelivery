<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\BRouter;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class BRComposer
{
    protected BRouter $brouter;

    protected CacheManager $cache;

    public function __construct(BRouter $brouter, CacheManager $cache)
    {
        $this->brouter = $brouter;

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
        $view->with('total_b_routers', $this->brouter->totalBrouter());
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
