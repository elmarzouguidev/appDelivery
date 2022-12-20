<?php

namespace  App\Exports;

use App\Models\Sameleon\User;

trait ForUser
{
    public function forUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
}
