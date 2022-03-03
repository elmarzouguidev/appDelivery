<?php

namespace App\Models\Sameleon\Traits;

trait ModelRoutes
{

    public function getEditUrlAttribute()
    {
        return route('sameleon:' . $this->getTable() . '.edit', $this->uuid);
    }

    public function getUpdateUrlAttribute()
    {
        return route('sameleon:' . $this->getTable() . '.update', $this->uuid);
    }

    public function getDeleteUrlAttribute()
    {
        return route('sameleon:' . $this->getTable() . '.delete');
    }
}
