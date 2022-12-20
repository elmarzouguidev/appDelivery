<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\User;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class NewUserComposer
{
    protected User $user;

    protected CacheManager $cache;

    public function __construct(User $user, CacheManager $cache)
    {
        $this->user = $user;

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
        $view->with('new_users', $this->user->disabledUsers());
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
