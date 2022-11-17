<?php

namespace App\Models\Sameleon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GetModelByUuid;
use App\Traits\HasCode;
use App\Traits\UuidGenerator;
use Illuminate\Support\Str;
class Region extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;
    //use HasCode;

    protected $fillable = [
        'name',
        'slug',
        'active',
        'description',
        'code',
        'frais',
        'frais_city',
        'delivery_id',
        'delivery_uuid'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function delivery()
    {
        return $this->belongsTo(User::class, 'delivery_id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getFormatedFraisCityAttribute()
    {
        return number_format($this->frais_city,2);
    }
}
