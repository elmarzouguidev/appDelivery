<?php

namespace App\Models\Sameleon;

use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use UuidGenerator;

    protected $fillable = [
        'articleable_id',
        'articleable_type',
        'code_command',
        'date_command',
        'city',
        'status',
        'price_total',
        'frais',
        'command_id'
    ];

    protected  $casts = [
        'date_command' => 'date',
        'status' => 'integer',
        'price_total' => 'float'
    ];

    public function articleable()
    {
        return $this->morphTo();
    }


    public function command()
    {
        return $this->belongsTo(Command::class);
    }

    public function getFormatedMontantHtAttribute()
    {
        return number_format($this->montant_ht, 2);
    }

    public function getFormatedPrixUnitaireAttribute()
    {
        return number_format($this->prix_unitaire, 2);
    }
    
}
