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
        'reference',
        'notes',
        'price_total',
        'billable_id',
        'billable_type',
        'client_id',
        'client_uuid'
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

    public function getFormatedPriceTotalAttribute()
    {
        return number_format($this->price_total, 2);
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


    public static function boot()
    {

        parent::boot();
        static::creating(function ($model) {

            $number = self::max('id') + 1;
            $model->code = str_pad($number, 5, 0, STR_PAD_LEFT);
            $model->full_number = 'REGL-' . str_pad($number, 5, 0, STR_PAD_LEFT);
        });
    }
}
