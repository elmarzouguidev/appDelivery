<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BLivraison extends Model
{
    use HasFactory;

    use UuidGenerator;
    use GetModelByUuid;

    protected $fillable = [
        'uuid',
        'code',
        'full_number',
        'user_id',
        'city_id',
        'city_uuid',
        'notes',
        'bon_date',
        'active',
        'closed',
    ];

    // protected $dates = ['due_date'];

    protected  $casts = [

        'bon_date' => 'date:Y-m-d',
        'active' => 'boolean',
        'closed' => 'boolean'
    ];

    public function getTotalPriceAttribute()
    {
        return $this->articles->sum('price_total');
    }

    public function getTotalCommandsAttribute()
    {
        return $this->articles->count();
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function articles()
    {
        return $this->hasMany(BLArticle::class);
    }
    
    public static function boot()
    {

        parent::boot();

        static::creating(function ($model) {

            $number = ($model->max('code') + 1);
            
            $code = str_pad($number, 5, 0, STR_PAD_LEFT);

            $model->code = $code;

            $model->full_number = 'BL-' . $code;

        });
    }

}
