<?php

namespace App\Models\Sameleon\Chart;

use App\Scopes\ClientCommandScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CommandChart extends Model
{

    use HasFactory;

    protected $table = "commands";


    protected static function booted()
    {
        static::addGlobalScope(new ClientCommandScope);
    }
}
