<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;


    protected $fillable = [
        'uuid',
        'name',
        'color',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function commands()
    {
        return $this->belongsToMany(Command::class, 'tag_command');
    }
}
