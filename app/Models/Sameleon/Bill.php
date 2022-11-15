<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Bill extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    use GetModelByUuid;
    use UuidGenerator;

    protected $fillable = [
        'bill_date',
        'bill_mode',
        'bank_name',
        'bank_rib',
        'reference',
        'notes',
        'price_total',
        'billable_id',
        'billable_type',
        'client_id',
        'client_uuid',
        'delivery_id',
        'delivery_uuid',
    ];

    protected  $casts = [
        'bill_date' => 'date:Y-m-d',
    ];

    public function billable()
    {
        return $this->morphTo();
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    /*public function getFormatedPriceTotalAttribute()
    {
        return number_format($this->price_total - $this->billable->formated_frais, 2);
    }*/

    public function getFormatedPriceTotalAttribute()
    {
        return number_format($this->price_total , 2);
    }

    public function getFormatedTotalAttribute()
    {
        return number_format($this->sum('price_total'), 2);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(800)
            ->height(800)
            ->sharpen(10)
            ->optimize();
    }


    public function scopeTotalChiffreVersed($query)
    {

        if (isClient()) {

            return $query
                ->whereClientId(auth()->id())
                ->whereClientUuid(auth()->user()->uuid)
                ->get()
                ->sum('price_total');
        } 
        elseif(isDelivery())
        {
            return $query->whereDeliveryId(delivery()->id)
            ->whereDeliveryUuid(delivery()->uuid)
            ->get()
            ->sum('price_total');
        } 
        else {
            return $query->get()->sum('price_total');
        }
    }

    public static function boot()
    {

        parent::boot();
        
        static::creating(function ($model) {

          
            if(isDelivery())
            {
                $number = self::max('delivery_code') + 1;
                $model->delivery_code = str_pad($number, 5, 0, STR_PAD_LEFT);
                $model->delivery_full_number = 'REGL-D-' . str_pad($number, 5, 0, STR_PAD_LEFT);   
            }
            else{

                $number = self::max('code') + 1;
                $model->code = str_pad($number, 5, 0, STR_PAD_LEFT);
                $model->full_number = 'REGL-' . str_pad($number, 5, 0, STR_PAD_LEFT);
            }
           
        });
    }
}
