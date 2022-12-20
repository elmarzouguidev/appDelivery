<?php

namespace App\Models\Sameleon;

use App\Models\Sameleon\Traits\ModelHelpers;
use App\Models\Sameleon\Traits\ModelRoutes;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use GetModelByUuid;
    use UuidGenerator;
    use ModelRoutes;
    use ModelHelpers;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'user_uuid',
        'user_id',
        'total_commands',
        'is_out',
        'can_ramassage',
        'notes',
        'qte_rest',
        'qte_global',
        'is_imported',
    ];

    protected $casts = [
        'is_out' => 'boolean',
        'can_ramassage' => 'boolean',
        'is_imported' => 'boolean',
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

    public function stocks()
    {
        return $this->hasMany(Stock::class);
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
        return $this->qte_rest < $qte;
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

    public function scopeFilterClient(Builder $query, $clientId): Builder
    {
        return $query->where('user_id', $clientId);
    }

    public function scopeFilterStock(Builder $query, $stock): Builder
    {
        dd($stock);
    }

    public function scopeFilterDate(Builder $query, $date): Builder
    {
        return $query->where('created_at', Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d'));
    }

    public function scopeNewProducts($query)
    {
        return $query->latest()->count();
    }

    public static function boot()
    {
        parent::boot();

        $prefixer = 'SM.PROD-';

        static::creating(function ($model) use ($prefixer) {
            $number = (self::max('id') + 1);

            $model->code = $prefixer.str_pad($number, 5, 0, STR_PAD_LEFT);
        });
    }
}
