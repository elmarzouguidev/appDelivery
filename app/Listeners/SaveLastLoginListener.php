<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Jenssegers\Agent\Agent;

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

    public function handle(Login $event)
    {
        // dd($event->guard,'----',$event->user);

        /*$version = (new Agent())->platform();

        $event->user->lastLogin()->create([
            'ip' => request()->ip(),
            'user_id' => $event->user->id,
            'logged_in_at' => Carbon::now(),
            'device' => (new Agent())->browser(),
            'device_name' => (new Agent())->device(),
            'system' => (new Agent())->platform(),
        ]);*/
    }
}
