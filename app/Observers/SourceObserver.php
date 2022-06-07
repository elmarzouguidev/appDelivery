<?php

namespace App\Observers;

use App\Models\Sameleon\Source;

class SourceObserver
{
    /**
     * Handle the Source "created" event.
     *
     * @param  \App\Models\Sameleon\Source  $source
     * @return void
     */
    public function created(Source $source)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Source "updated" event.
     *
     * @param  \App\Models\Sameleon\Source  $source
     * @return void
     */
    public function updated(Source $source)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Source "deleted" event.
     *
     * @param  \App\Models\Sameleon\Source  $source
     * @return void
     */
    public function deleted(Source $source)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Source "restored" event.
     *
     * @param  \App\Models\Sameleon\Source  $source
     * @return void
     */
    public function restored(Source $source)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Source "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Source  $source
     * @return void
     */
    public function forceDeleted(Source $source)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {

        cache()->pull('all_sources_cache');
    }
}
