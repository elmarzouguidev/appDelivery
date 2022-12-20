<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Annonce;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class AnnonceComposer
{
    protected Annonce $annonce;

    protected CacheManager $cache;

    public function __construct(Annonce $annonce, CacheManager $cache)
    {
        $this->annonce = $annonce;

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
        $view->with('annonces', $this->annonce->activeAnnonces());
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
