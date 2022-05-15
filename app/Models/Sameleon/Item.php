<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    protected $fillable = [
        'uuid',
        'code',
        'command_id',
        'command_uuid',
        'product_id',
        'product_uuid',
        'designation',
        'product',
        'quantity',
        'prix_uni',
        'prix_total',
        'options',
    ];

    public function command()
    {
        return $this->belongsTo(Command::class);
    }

}
