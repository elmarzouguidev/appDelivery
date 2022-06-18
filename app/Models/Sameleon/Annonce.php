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
    ];

    protected  $casts = [
        'active' => 'boolean',
        'periode' => 'date'
    ];
}
