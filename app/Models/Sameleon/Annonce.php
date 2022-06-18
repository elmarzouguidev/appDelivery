<?php

namespace App\Models\Sameleon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;
use App\Traits\GetModelByUuid;

class Annonce extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    protected $fillable = [
        'title',
        'description',
        'image',
        'active',
        'periode',
        'viewed'
    ];

    protected  $casts = [
        'active' => 'boolean',
        'periode' => 'date',
        'viewed' => 'array'
    ];


    public function setViewedAttribute($value)
    {
        $this->attributes['viewed'] = json_encode($value);
    }

    public function getViewedAttribute($value)
    {
        return json_decode($value);
    }
    
    public function scopeActiveAnnonces($query)
    {
        return $query->whereActive(true)->latest()->first();
    }
}
