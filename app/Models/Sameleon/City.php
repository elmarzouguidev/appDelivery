<?php

namespace App\Models\Sameleon;

use App\Status\Status;
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
    //use HasCode;

    protected $fillable = [
        'name',
        'active',
        'frais',
        'code',
        'has_profit',
        'profit'
    ];

    protected $casts = [
        'frais' => 'float',
        'profit' => 'float',
        'has_profit'=>'boolean'
    ];

    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function getTotalChiffreAttribute()
    {
        return $this->commands()->whereStatus(Status::LIVRE)
            ->withSum('items', 'prix_total')
            ->get()
            ->sum('items_sum_prix_total');
    }

    public function clients()
    {
        return $this->hasMany(User::class);
    }

    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
