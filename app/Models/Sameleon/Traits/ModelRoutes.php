<?php

namespace App\Models\Sameleon\Traits;

trait ModelRoutes
{

    public function getEditUrlAttribute()
    {
        return route('client:' . $this->getTable() . '.edit', $this->uuid);
    }

    public function getUpdateUrlAttribute()
    {
        return route('client:' . $this->getTable() . '.update', $this->uuid);
    }

    public function getDeleteUrlAttribute()
    {
        return route('client:' . $this->getTable() . '.delete');
    }
}
