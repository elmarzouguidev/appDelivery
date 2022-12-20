<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Command;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class SubDeliveryComposer
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
        $view->with('total_command', $this->command->subDeliveryTotalCommands());
        $view->with('total_command_livred', $this->command->subDeliveryTotalCommandsLivred());
        $view->with('total_command_encours', $this->command->subDeliveryTotalCommandsEncours());
        $view->with('total_command_p_reponse', $this->command->subDeliveryTotalCommandsNonResponde());
        $view->with('total_command_p_reported', $this->command->subDeliveryTotalCommandsReported());
        $view->with('total_command_cancled', $this->command->subDeliveryTotalCommandsCancled());
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
