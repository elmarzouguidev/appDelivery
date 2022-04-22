<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Command;
use App\Models\Sameleon\Reclamation;
use Illuminate\View\View;
use Illuminate\Cache\CacheManager;

class NavBarComposer
{

    protected Command $command;
    protected Reclamation $reclamation;

    protected CacheManager $cache;

    public function __construct(Command $command, Reclamation $reclamation, CacheManager $cache)
    {
        $this->command = $command;

        $this->reclamation = $reclamation;

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


        $view->with('total_new_command', $this->command->totalNewCommands());
        $view->with('total_new_reclamations', $this->reclamation->totalNewReclamations());

        /*$view->with('categoriesMenu', $this->cache->remember('categoriesMenu', $this->timeToLive(), function () {
             return $this->categories->categoryInMenu();
         })); */
    }


    private function timeToLive()
    {

        return \Carbon\Carbon::now()->addDays(30);
    }
}
