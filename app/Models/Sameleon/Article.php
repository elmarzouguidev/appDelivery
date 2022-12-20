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
        'profit',
        'is_delivery',
        'command_id',
        'command_uuid',
    ];

    protected $casts = [
        'date_command' => 'date',
        'price_total' => 'float',
        'profit' => 'float',
        'is_delivery' => 'boolean',
    ];

    public function articleable()
    {
        return $this->morphTo();
    }

    public function command()
    {
        return $this->belongsTo(Command::class);
    }

    public function getFormatedPriceTotalAttribute()
    {
        return number_format($this->price_total, 2);
    }

    public function getFormatedPrixUnitaireAttribute()
    {
        return number_format($this->prix_unitaire, 2);
    }
}
