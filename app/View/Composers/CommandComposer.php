<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Command;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class CommandComposer
{
    protected Command $command;

    protected CacheManager $cache;

    public function __construct(Command $command, CacheManager $cache)
    {
        $this->command = $command;

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
        $view->with('total_command', $this->command->totalCommands());

        $view->with('total_chiffre_affaires', $this->command->totalChiffre());

        $view->with('total_command_livred', $this->command->totalCommandsLivred());
        $view->with('total_command_encours', $this->command->totalCommandsEncours());
        $view->with('total_command_p_reponse', $this->command->totalCommandsNonResponde());
        $view->with('total_command_p_reported', $this->command->totalCommandsReported());
        $view->with('total_command_cancled', $this->command->totalCommandsCancled());
        /*$view->with('categoriesMenu', $this->cache->remember('categoriesMenu', $this->timeToLive(), function () {
             return $this->categories->categoryInMenu();
         })); */
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
