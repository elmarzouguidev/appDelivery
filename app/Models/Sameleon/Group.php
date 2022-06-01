<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;


    protected $fillable = [
        'uuid',
        'user_uuid',
        'user_id',
        'name',
        'description',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function moderator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clients()
    {
        return $this->hasMany(User::class);
    }
}
