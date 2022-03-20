<?php

namespace App\Models\Sameleon;

use App\Models\User;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clients()
    {
        return $this->hasMany(User::class);
    }
}
