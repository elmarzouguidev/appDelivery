<?php

namespace App\Observers;

use App\Models\Sameleon\Region;

class RegionObserver
{
    /**
     * Handle the Region "created" event.
     *
     * @param  \App\Models\Sameleon\Region  $region
     * @return void
     */
    public function created(Region $region)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Region "updated" event.
     *
     * @param  \App\Models\Sameleon\Region  $region
     * @return void
     */
    public function updated(Region $region)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Region "deleted" event.
     *
     * @param  \App\Models\Sameleon\Region  $region
     * @return void
     */
    public function deleted(Region $region)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Region "restored" event.
     *
     * @param  \App\Models\Sameleon\Region  $region
     * @return void
     */
    public function restored(Region $region)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Region "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Region  $region
     * @return void
     */
    public function forceDeleted(Region $region)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {
        cache()->pull('all_regions_cache');
    }
}
