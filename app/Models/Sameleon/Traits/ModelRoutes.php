<?php

namespace App\Models\Sameleon\Traits;

trait ModelRoutes
{
    public function getEditUrlAttribute()
    {
        return route('admin:'.$this->getTable().'.edit', $this->uuid);
    }

    public function getUpdateUrlAttribute()
    {
        return route('admin:'.$this->getTable().'.update', $this->uuid);
    }

    public function getDeleteUrlAttribute()
    {
        return route('admin:'.$this->getTable().'.delete');
    }
}
