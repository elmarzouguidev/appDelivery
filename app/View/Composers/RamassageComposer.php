<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Ramassage;
use Illuminate\View\View;
use Illuminate\Cache\CacheManager;


class RamassageComposer
{

    protected CacheManager $cache;

    public function __construct(CacheManager $cache)
    {
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
        if (isClient()) {

            $ramassage = Ramassage::where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->whereActive(true)
                ->whereAccepted(true)
                ->doesntHave('product')
                ->count();
        } else {
            $ramassage = Ramassage::whereActive(true)
                ->whereAccepted(false)
                ->count();
        }

        $view->with('ramassage', $ramassage);
    }
}
