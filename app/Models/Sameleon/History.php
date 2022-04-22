<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    protected $fillable = [
        'uuid',
        'user_id',
        'user_uuid',
        'action',
        'description',
        'historyable_id',
        'historyable_type'
    ];

    public function historyable()
    {
        return $this->morphTo();
    }
}
