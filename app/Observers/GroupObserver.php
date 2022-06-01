<?php

namespace App\Observers;

use App\Models\Sameleon\Group;

class GroupObserver
{
    /**
     * Handle the Group "created" event.
     *
     * @param  \App\Models\Sameleon\Group  $group
     * @return void
     */
    public function created(Group $group)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Group "updated" event.
     *
     * @param  \App\Models\Sameleon\Group  $group
     * @return void
     */
    public function updated(Group $group)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Group "deleted" event.
     *
     * @param  \App\Models\Sameleon\Group  $group
     * @return void
     */
    public function deleted(Group $group)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Group "restored" event.
     *
     * @param  \App\Models\Sameleon\Group  $group
     * @return void
     */
    public function restored(Group $group)
    {
        $this->clearAllCache();
    }

    /**
     * Handle the Group "force deleted" event.
     *
     * @param  \App\Models\Sameleon\Group  $group
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        $this->clearAllCache();
    }

    private function clearAllCache()
    {

        cache()->pull('all_groups_cache');
    }
}
