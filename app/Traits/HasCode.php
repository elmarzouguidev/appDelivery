<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait HasCode
{
    public static function bootHasCode(): void
    {
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'code')) {
                $number = (self::max('id') + 1);

                $model->code = Str::singular($model->getTable()).'#'.str_pad($number, 5, 0, STR_PAD_LEFT);
            }
        });
    }
}
