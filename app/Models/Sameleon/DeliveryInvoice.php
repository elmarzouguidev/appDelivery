<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryInvoice extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    protected $fillable = [
        'cloture',
        'type',
        'invoice_date',
        'city_id',
        'city_uuid',
        'delivery_id',
        'delivery_uuid'
    ];

    // protected $dates = ['due_date'];

    protected  $casts = [

        'invoice_date' => 'date:Y-m-d',
        'cloture' => 'boolean'
    ];

    public function getFormatedPriceHtAttribute()
    {
        return number_format($this->price_ht, 2);
    }

    public function getFormatedPriceTotalAttribute()
    {
        return number_format($this->price_total, 2);
    }

    public function getFormatedTotalTvaAttribute()
    {
        return number_format($this->price_tva, 2);
    }

    public function getFormatedTotalBrutAttribute()
    {
        //dd(Carbon::yesterday()->format('d'));
        /*$refused = $this->commands()->where('status', Status::REFUSE)
            ->whereDay('created_at', now()->format('d'))
            ->whereNotNull('delivered_at');
        $total = $refused->withSum('articles', 'articles.price_total')->get()->map(function($item,$key){
           // dd($item);
            return $item->articles_sum_articlesprice_total;
        })->sum();
        //dd($total);
        //return $articles; */
        //return ($this->articles->sum('price_total') - $total);
        return $this->articles->sum('price_total');
    }

    public function getFormatedFraisAttribute()
    {
        $frais = $this->articles->sum('frais');

        return number_format($frais, 2);
    }

    public function bill()
    {
        return $this->morphOne(Bill::class, 'billable');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function articles()
    {
        return $this->morphMany(DeliveryInvoiceArticle::class, 'articleable');
    }

    public function commands()
    {
        return $this->hasMany(Command::class,'delivery_invoice_id');
    }

    public function scopeInvoiceNonClosed($query)
    {
        if (isDelivery()) {
            return $query->whereCloture(false)
                ->latest()->count();
        }
        return 0;
    }

    public function scopeTotalChiffreNonVersed($query)
    {

        if (isDelivery()) {

            return $query
                ->whereDeliveryId(delivery()->id)
                ->whereDeliveryUuid(delivery()->uuid)
                ->doesntHave('bill')
                ->withSum('articles', 'delivery_invoice_articles.price_total')
                ->withSum('articles', 'delivery_invoice_articles.frais')
                ->get()
                ->map(function($item)
                    {
                        return ['total_pricer' => $item->articles_sum_articlesprice_total - $item->articles_sum_articlesfrais];
                    }
                )->sum('total_pricer');
        } 
        else {
            return $query->doesntHave('bill')
            ->withSum('articles', 'delivery_invoice_articles.price_total')
            ->withSum('articles', 'delivery_invoice_articles.frais')
            ->get()
            ->map(function($item)
                {
                    return ['total_pricer' => $item->articles_sum_articlesprice_total - $item->articles_sum_articlesfrais];
                }
            )->sum('total_pricer');

        }
    }

    public static function boot()
    {

        parent::boot();

        static::creating(function ($model) {


            if (self::count() <= 0) {

                $number = getDocument()->delivery_invoice_start;
            } else {

                $number = ($model->max('code') + 1);
            }

            $code = str_pad($number, 5, 0, STR_PAD_LEFT);

            $model->code = $code;

            $model->full_number = getDocument()->delivery_invoice_prefix . $code;
        });
    }
}
