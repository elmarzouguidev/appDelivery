<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class SaveLastLoginListener
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
     * @param  CustomerLogin  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // dd($event->guard,'----',$event->user);

        $event->user->lastLogin()->create([
            'ip' => request()->ip(),
            'user_id' => $event->user->id,
            'logged_in_at' => Carbon::now(),
            'device' => 'web_Browser'
        ]);
    }
}
