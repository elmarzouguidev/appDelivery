<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    protected $fillable = [
        'uuid',
        'name',
        'code_bank',
        'code_swift',
        'code_rib',
        'logo',
        'addresse',
        'description',
        'active'
    ];

    protected  $casts = [
        'active' => 'boolean',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(UserBank::class);
    }
}
