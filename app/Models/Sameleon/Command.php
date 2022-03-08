<?php

namespace App\Models\Sameleon;

use App\Models\User;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Command extends Model
{

    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_command', 'command_id', 'product_id')->withPivot(['quantity', 'price_ht']);
    }

    public function getTotalPriceAttribute()
    {
        //return $this->products()->sum('price_ht');

        return number_format($this->products()->sum('price_ht'), 2);
    }

    public static function boot()
    {

        parent::boot();

        static::creating(function ($model) {

            $number = 'CMD-' . auth()->user()->code . ($model->max('id') + 1);

            $code = str_pad($number, 5, 0, STR_PAD_LEFT);

            $model->code = $code;

            $model->track_code = str_pad(($model->max('id') + 1), 5, 0, STR_PAD_LEFT) . Str::random(10);
        });
    }
}
