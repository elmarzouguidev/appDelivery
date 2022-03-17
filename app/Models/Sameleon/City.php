<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    protected $fillable = [
        'name',
        'active'
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
