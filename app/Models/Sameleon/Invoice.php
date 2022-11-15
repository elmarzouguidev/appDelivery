<?php

namespace App\Models\Sameleon;

use App\Scopes\InvoiceScope;
use App\Status\Status;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Invoice extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    use InvoiceScope;

    protected $fillable = [
        'cloture',
        'type',
        'invoice_date',
        'user_id',
        'user_uuid',
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

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function articles()
    {
        return $this->morphMany(Article::class, 'articleable');
    }

    /*public function commands()
    {
        return $this->belongsToMany(Command::class, 'command_invoice', 'invoice_id', 'command_id');
    }*/

    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function scopeInvoiceNonClosed($query)
    {
        if (isAdmin()) {
            return $query->whereCloture(false)
                ->latest()->count();
        }
        return 0;
    }

    public function scopeTotalChiffreNonVersed($query)
    {

        if (isClient()) {

            return $query
                ->whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->doesntHave('bill')
                ->withSum('articles', 'articles.price_total')
                ->get()
                ->sum('articles_sum_articlesprice_total');
        } 
        else {
            return $query->doesntHave('bill')
            ->withSum('articles', 'articles.price_total')
            ->get()->sum('articles_sum_articlesprice_total');
        }
    }

    public static function boot()
    {

        parent::boot();

        static::creating(function ($model) {


            if (self::count() <= 0) {

                $number = getDocument()->invoice_start;
            } else {

                $number = ($model->max('code') + 1);
            }

            $code = str_pad($number, 5, 0, STR_PAD_LEFT);

            $model->code = $code;

            $model->full_number = getDocument()->invoice_prefix . $code;
        });
    }
}
