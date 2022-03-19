<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;


    protected $fillable = ['status', 'type', 'is_paid','invoice_date'];

    // protected $dates = ['due_date'];

    protected  $casts = [
        'due_date' => 'date:Y-m-d',
        'invoice_date' => 'date:Y-m-d',
        
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
        return number_format($this->articles->sum('price_total'), 2);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
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
