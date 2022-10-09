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
        'cloture',
        'type',
        'bon_date',
        'user_id',
        'user_uuid'
    ];

    // protected $dates = ['due_date'];

    protected  $casts = [

        'bon_date' => 'date:Y-m-d',
        'cloture' => 'boolean'
    ];



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


    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function scopeBonNonClosed($query)
    {
        if (isAdmin()) {
            return $query->whereCloture(false)
                ->latest()->count();
        }
        return 0;
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
