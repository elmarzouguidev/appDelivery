<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    protected $fillable = [
        'name',
        'website',
        'logo',
        'city',
        'addresse',
        'telephone',
        'email',
        'rc',
        'ice',
        'cnss',
        'patente',
        'if',
    ];

    public function client()
    {
        return $this->belongsTo(User::class);
    }

}
