<?php

namespace App\Models\Sameleon\Traits;

trait ModelHelpers
{
    public function associateWith($relation, $model)
    {
        $this->$relation()->associate($model);

        $this->user_uuid = $model->uuid;

        return $model;
    }
}
