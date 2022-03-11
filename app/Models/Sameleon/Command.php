<?php

namespace App\Models\Sameleon;

use App\Models\Sameleon\Traits\ModelRoutes;
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
    use ModelRoutes;

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_command', 'command_id', 'product_id')->withPivot(['id', 'quantity', 'price_ht', 'price_total', 'designation']);
    }

    public function getTotalPriceAttribute()
    {
        //return $this->products()->sum('price_ht');

        return number_format($this->products()->sum('price_total'), 2);
    }

    public static function boot()
    {

        parent::boot();

        $prefix = 'CMD-';

        static::creating(function ($model) use ($prefix) {

            $number = ($model->max('id') + 1);

            $code = str_pad($number, 5, 0, STR_PAD_LEFT);

            $model->code = $prefix . auth()->id() . '-' . $code;

            $model->track_code = str_pad(($model->max('id') + 1), 5, 0, STR_PAD_LEFT) . Str::random(10);
        });
    }
}
