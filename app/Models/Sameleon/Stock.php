<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\HasCode;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;
    use HasCode;

    protected $fillable = [
        'uuid',
        'code',
        'user_id',
        'user_uuid',
        'product_id',
        'product_uuid',
        'qte_global',
        'qte_livre',
        'qte_expidite',
        'qte_endomage',
        'qte_rest',
        'notes',
        'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
