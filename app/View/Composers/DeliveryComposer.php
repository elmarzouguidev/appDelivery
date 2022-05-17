<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Command;
use Illuminate\View\View;
use Illuminate\Cache\CacheManager;


class DeliveryComposer
{

    protected Command $command;

    protected CacheManager $cache;

    public function __construct(Command $command,CacheManager $cache)
    {
        $this->cache = $cache;

        $this->command = $command;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */

    public function compose(View $view)
    {
        $view->with('total_command_with_delivery', $this->command->totalCommandsWithDelivery());
    }
}
