<?php

namespace App\Models\Sameleon;

use App\Models\Sameleon\Traits\ModelRoutes;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
class Command extends Model
{

    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;
    use ModelRoutes;

    //protected $appends  = ['update_url'];

    protected $fillable = ['status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_command', 'command_id', 'product_id')->withPivot(['id', 'quantity', 'price_ht', 'price_total', 'designation']);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function getTotalPriceAttribute()
    {
        //return $this->products()->sum('price_ht');

        return number_format($this->products()->sum('price_total'), 2);
    }

    public function scopeFromTo(Builder $query, $dateFrom, $dateTo): Builder
    {
        return $query->whereBetween(
            'created_at',
            [
                Carbon::createFromFormat('m/d/Y', $dateFrom)->format('Y-m-d'),
                Carbon::createFromFormat('m/d/Y', $dateTo)->format('Y-m-d')
            ]
        );
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
