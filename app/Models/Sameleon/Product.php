<?php

namespace App\Models\Sameleon;

use App\Models\Sameleon\Traits\ModelRoutes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;

use Appstract\Stock\HasStock;
use Illuminate\Support\Facades\Cache;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use GetModelByUuid;
    use UuidGenerator;

    use ModelRoutes;

    use HasStock;

    protected $fillable = [
        'slug',
        'user_uuid',
        'user_id',
        'total_commands',
        'is_out',
        'can_ramassage',
        'notes'
    ];

    protected $casts = [
        'is_out' => 'boolean',
        'can_ramassage' => 'boolean',
    ];

    //protected $with = ['stockMutations'];

    /*public function stock()
    {
        return $this->hasOne(Stock::class);
    }*/

    public function ramassage()
    {
        return $this->hasOne(Ramassage::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commands()
    {
        return $this->belongsToMany(Command::class, 'product_command', 'product_id', 'command_id')->withPivot(['quantity', 'price_ht']);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function isOutOfStock(int $qte)
    {
        //dd($this->inStock($qte));
        return !$this->inStock($qte);
    }

    public function getFormatedPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    public function getTotalCommandsQteAttribute()
    {
        return $this->items->sum('quantity');
    }

    /*public function getStockAttribute()
    {
        Cache::remember('stockablded', 500, function () {
            return $this->stock();
        });
    }*/

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

        $prefixer = "SM.PROD-";

        static::creating(function ($model) use ($prefixer) {

            $number = (self::max('id') + 1);

            $model->code = $prefixer . str_pad($number, 5, 0, STR_PAD_LEFT);
        });
    }
}
