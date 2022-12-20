<?php

namespace App\Models\Sameleon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;

    protected $fillable = [
        'metricable_id',
        'metricable_type',
        'name',
        'date',
        'value',
        'data',
        'type',
    ];

    protected $casts = [];

    public function metricable()
    {
        return $this->morphTo();
    }
}
