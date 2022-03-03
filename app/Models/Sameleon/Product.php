<?php

namespace App\Models\Sameleon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use GetModelByUuid;
    use UuidGenerator;

    public function client()
    {
        return $this->belongs(User::class,'user_id');
    }

    public function commands()
    {
        return $this->belongsToMany(Command::class,'product_command','product_id','command_id');
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

        $prefixer = "PROD-";

        static::creating(function ($model) use ($prefixer) {

            $number = (self::max('id') + 1);

            $model->code = $prefixer . str_pad($number, 5, 0, STR_PAD_LEFT);
        });
    }
}
