<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    protected $fillable = [
        'title',
        'group',
        'description',
        'image',
        'active',
        'periode',
        'viewed',
        'type',
    ];

    protected $casts = [
        'active' => 'boolean',
        'periode' => 'date',
        'viewed' => 'array',
    ];

    public function setViewedAttribute($value)
    {
        $this->attributes['viewed'] = json_encode($value);
    }

    public function getViewedAttribute($value)
    {
        return json_decode($value);
    }

    public function scopeActiveConditions($query)
    {
        return $query->whereActive(true)
        ->latest()->first();
    }
}
