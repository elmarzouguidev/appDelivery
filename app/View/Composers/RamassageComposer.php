<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Product;
use App\Models\Sameleon\Stock;
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

            $ramassage = Product::where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->doesntHave('ramassage')
                ->whereIsOut(true)
                ->where('can_ramassage', true)
                ->count();
        } else {
            $ramassage = Product::whereIsOut(true)

                ->where('can_ramassage', false)
                ->count();
        }

        $view->with('ramassage', $ramassage);
    }
}
