<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
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

    public function scopeActiveAnnonces($query)
    {
        $group = ['all'];

        if (isAdmin()) {
            $group = ['admins', 'all'];
        } elseif (isClient()) {
            $group = ['clients'];
        } elseif (isDelivery()) {
            $group = ['delivery'];
        } else {
            $group = ['all'];
        }

        return $query->whereActive(true)
        ->whereIn('group', $group)
        ->latest()->first();
    }
}
