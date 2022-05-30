<?php

namespace App\Observers;

use App\Models\Sameleon\City;

class CityObserver
{
    /**
     * Handle the City "created" event.
     *
     * @param  \App\Models\Sameleon\City  $city
     * @return void
     */
    public function created(City $city)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the City "updated" event.
     *
     * @param  \App\Models\Sameleon\City  $city
     * @return void
     */
    public function updated(City $city)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the City "deleted" event.
     *
     * @param  \App\Models\Sameleon\City  $city
     * @return void
     */
    public function deleted(City $city)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the City "restored" event.
     *
     * @param  \App\Models\Sameleon\City  $city
     * @return void
     */
    public function restored(City $city)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the City "force deleted" event.
     *
     * @param  \App\Models\Sameleon\City  $city
     * @return void
     */
    public function forceDeleted(City $city)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {
        cache()->pull('all_cities_cache');
    }
}
