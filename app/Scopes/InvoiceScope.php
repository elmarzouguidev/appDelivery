<?php

namespace App\Scopes;

trait InvoiceScope
{
    public function scopeAuthClient($query)
    {
        return $query->whereUserId(auth()->id())
            ->whereUserUuid(auth()->user()->uuid);
    }
}
