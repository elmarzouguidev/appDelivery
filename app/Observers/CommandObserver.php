<?php

namespace App\Observers;

use App\Models\Sameleon\Command;

class CommandObserver
{
    /**
     * Handle the Command "created" event.
     *
     * @param  \App\Models\Sameleon\Command  $command
     * @return void
     */
    public function created(Command $command)
    {
        $this->clearAllCachedArchive();
    }

    /**
     * Handle the Command "updated" event.
     *
     * @param  \App\Models\Sameleon\Command  $command
     * @return void
     */
    public function updated(Command $command)
    {
        //
    }

    /**
     * Handle the Command "deleted" event.
     *
     * @param  \App\Models\Sameleon\Command  $command
     * @return void
     */
    public function deleted(Command $command)
    {
        //
    }

    /**
     * Handle the Command "restored" event.
     *
     * @param  \App\Models\Sameleon\Command  $command
     * @return void
     */
    public function restored(Command $command)
    {
        //
    }

    /**
     * Handle the Command "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Command  $command
     * @return void
     */
    public function forceDeleted(Command $command)
    {
        //
    }

    private function clearAllCachedArchive()
    {

        if (auth()->user()->hasRole('Client')) {

            $cacheKey = "all_commands_archived_cache_" . auth()->user()->uuid;
            cache()->pull($cacheKey);
            cache()->pull('all_commands_archived_cache');
        } else {
            cache()->pull('all_commands_archived_cache');
        }
    }
}
