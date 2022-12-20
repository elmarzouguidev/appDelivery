<?php

namespace App\Http\View\Composers;

use App\Models\Sameleon\Command;
use Illuminate\View\View;

class NavBarDeliveryComposer
{
    protected Command $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sub_delivery_total_new_command', $this->command->subDeliveryTotalNewCommands());
    }
}
