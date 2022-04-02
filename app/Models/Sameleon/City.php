<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\HasCode;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;
    use HasCode;

    protected $fillable = [
        'name',
        'active',
        'frais'
    ];

    protected $casts = [
        'frais' => 'float',
    ];

    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
