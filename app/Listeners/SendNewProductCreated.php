<?php

namespace App\Listeners;

use App\Models\Sameleon\User;
use App\Notifications\ProductCreated;
use Illuminate\Support\Facades\Notification;

class SendNewProductCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::role('SuperAdmin')->get();

        Notification::send($admins, new ProductCreated($event->product));
    }
}
