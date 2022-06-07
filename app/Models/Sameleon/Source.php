<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    protected $fillable = [
        'uuid',
        'integration_id',
        'integration_uuid',
        'user_id',
        'user_uuid',
        'platform',
        'name',
        'header',
        'secret',
        'domain',
        'route',
        'full_url',
        'options',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function integration()
    {
        return $this->belongsTo(Integration::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
