<?php

namespace App\Observers;

use App\Models\Sameleon\Integration;

class IntegrationObserver
{
    /**
     * Handle the Integration "created" event.
     *
     * @param  \App\Models\Sameleon\Integration  $integration
     * @return void
     */
    public function created(Integration $integration)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Integration "updated" event.
     *
     * @param  \App\Models\Sameleon\Integration  $integration
     * @return void
     */
    public function updated(Integration $integration)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Integration "deleted" event.
     *
     * @param  \App\Models\Sameleon\Integration  $integration
     * @return void
     */
    public function deleted(Integration $integration)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Integration "restored" event.
     *
     * @param  \App\Models\Sameleon\Integration  $integration
     * @return void
     */
    public function restored(Integration $integration)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Integration "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Integration  $integration
     * @return void
     */
    public function forceDeleted(Integration $integration)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {

        cache()->pull('all_integrations_cache');
    }
}
