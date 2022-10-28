<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Annonce;
use App\Models\Sameleon\Condition;
use Illuminate\View\View;
use Illuminate\Cache\CacheManager;

class ConditionComposer
{

    protected Condition $condition;

    protected CacheManager $cache;

    public function __construct(Condition $condition, CacheManager $cache)
    {
        $this->condition = $condition;

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

        $view->with('conditions', $this->condition->activeConditions());

    }
    

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
