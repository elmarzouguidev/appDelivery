<?php

namespace App\Models\Sameleon;

use App\Models\Sameleon\Traits\ModelRoutes;
use App\Status\Status;
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

    //protected $with = ['products'];

    protected $fillable = [
        'status',
        'price_total',
        'frais',
        'invoice_id',
        'invoice_uuid',
        'user_id',
        'user_uuid',
        'client_name',
        'client_phone',
        'client_phone',
        'client_city',
        'client_address',
        'product_ref',
        'qte',
        'price_total',
        'source',
        'boutique',
        'is_imported',
        'delivered_at',
        'region_id',
        'region_uuid',
        'company_uuid',
        'company_id'
    ];

    protected  $casts = [
        'delivered_at' => 'date:d-m-Y',

    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_command', 'command_id', 'product_id')
            ->withPivot(['id', 'quantity', 'price_ht', 'price_total', 'designation']);
    }

    /*public function invoice()
    {
        return $this->belongsToMany(Invoice::class, 'command_invoice', 'command_id', 'invoice_id');
          
    }*/

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }


    public function reclamation()
    {
        return $this->hasOne(Reclamation::class);
    }

    public function histories()
    {
        return $this->morphMany(History::class, 'historyable');
    }

    public function setClientAddressAttribute($value)
    {
        $this->attributes['client_address'] = nl2br($value);
    }

    public function getTotalPriceAttribute()
    {
        //return $this->products()->sum('price_ht');

        return number_format($this->products()->sum('price_total'), 2);
    }

    public function getDaysActiveAttribute()
    {
        return $this->created_at->diffInDays($this->updated_at);
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

    public function scopeProductFilters(Builder $query, $product): Builder
    {
        return $query->whereHas('products', function ($q) use ($product) {
            $q->where('product_id', $product);
        });
    }

    public function scopeCitiesFilters(Builder $query, $city): Builder
    {
        return $query->where('city_id', $city);
    }

    public function scopeTotalCommands($query)
    {
        if (auth()->user()->hasRole('Client')) {
            return $query->whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->count();
        } else {
            return $query->count();
        }
    }

    public function scopeTotalNewCommands($query)
    {
        if (auth()->user()->hasRole('Client')) {
            return $query->whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->whereStatus(Status::NON_TRAITE)
                ->count();
        } else {
            return $query->whereStatus(Status::NON_TRAITE)
                ->count();
        }
    }

    public function scopeTotalCommandsLivred($query)
    {
        if (auth()->user()->hasRole('Client')) {
            return $query->whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->whereStatus(Status::LIVRE)
                ->count();
        } else {
            return $query->whereStatus(Status::LIVRE)->count();
        }
    }

    public function scopeTotalCommandsEncours($query)
    {
        if (auth()->user()->hasRole('Client')) {
            return $query->whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->whereIn('status', [Status::ENCOURS, Status::EXPEDIE])->count();
        } else {
            return $query->whereIn('status', [Status::ENCOURS, Status::EXPEDIE])->count();
        }
    }

    public function scopeTotalCommandsNonResponde($query)
    {
        if (auth()->user()->hasRole('Client')) {
            return $query
                ->whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->whereIn('status', [
                    Status::PAS_DE_REPONSE,
                    Status::PAS_DE_REPONSE_2,
                    Status::PAS_DE_REPONSE_3,
                    Status::PAS_DE_REPONSE_4,
                    Status::PAS_DE_REPONSE_5,
                    Status::INJOIGNABLE
                ])->count();
        } else {


            return $query->whereIn('status', [
                Status::PAS_DE_REPONSE,
                Status::PAS_DE_REPONSE_2,
                Status::PAS_DE_REPONSE_3,
                Status::PAS_DE_REPONSE_4,
                Status::PAS_DE_REPONSE_5,
                Status::INJOIGNABLE
            ])->count();
        }
    }

    public function scopeTotalCommandsReported($query)
    {
        if (auth()->user()->hasRole('Client')) {
            return $query
                ->whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->whereIn('status', [
                    Status::REPORTE,
                    Status::INTERESSE
                ])->count();
        } else {
            return $query->whereIn('status', [
                Status::REPORTE,
                Status::INTERESSE
            ])->count();
        }
    }

    public function scopeTotalCommandsCancled($query)
    {
        if (auth()->user()->hasRole('Client')) {
            return $query
                ->whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->whereIn('status', [
                    Status::ANNULE,
                    Status::REFUSE
                ])->count();
        } else {
            return $query->whereIn('status', [
                Status::ANNULE,
                Status::REFUSE
            ])->count();
        }
    }

    public function scopeTotalChiffre($query)
    {

        if (auth()->user()->hasRole('Client')) {

            return $query
                ->whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->whereStatus(Status::LIVRE)
                ->withSum('products', 'product_command.price_total')
                ->get()
                ->sum('products_sum_product_commandprice_total');
        } else {
            return $query->whereStatus(Status::LIVRE)->withSum('products', 'product_command.price_total')->get()->sum('products_sum_product_commandprice_total');
        }
        /*return $this->with('products')->get()->each(function ($command) {
             dd($command->products->sum('pivot.price_total'));
            return  $command->products->each(function ($product) {
                //dd($product->pivot->sum('price_total'));
               
            });
        });*/
    }

    public static function boot()
    {

        parent::boot();

        $prefix = 'SM.ORD-';

        static::creating(function ($model) use ($prefix) {

            $number = ($model->max('id') + 1);

            $code = str_pad($number, 6, 0, STR_PAD_LEFT);

            $model->code = $prefix . $code . '-' . now()->format('dmY');

            $model->track_code = str_pad(($model->max('id') + 1), 5, 0, STR_PAD_LEFT) . Str::random(10);
        });
    }
}
