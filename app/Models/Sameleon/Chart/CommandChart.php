<?php

namespace App\Models\Sameleon\Chart;

use App\Scopes\ClientCommandScope;
use App\Scopes\DeliveryCommandScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandChart extends Model
{
    use HasFactory;

    protected $table = 'commands';

    protected static function booted()
    {
        if (isDelivery()) {
            static::addGlobalScope(new DeliveryCommandScope);
        } else {
            static::addGlobalScope(new ClientCommandScope);
        }
    }
}
