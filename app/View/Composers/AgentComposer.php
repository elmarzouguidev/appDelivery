<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Cache\CacheManager;
use Jenssegers\Agent\Agent;

class AgentComposer
{

    protected Agent $agent;

    protected CacheManager $cache;

    public function __construct(CacheManager $cache, Agent $agent)
    {
        $this->agent = $agent;

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

        $view->with('agent', $this->agent);

        /*$view->with('agent', $this->cache->remember('agent', $this->timeToLive(), function () {
             return $this->agent;
         })); */
    }


    private function timeToLive()
    {

        return \Carbon\Carbon::now()->addDays(30);
    }
}
