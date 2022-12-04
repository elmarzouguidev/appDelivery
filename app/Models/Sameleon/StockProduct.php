<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduct extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    protected $fillable = [
        'uuid',
        'product_id',
        'product_uuid',
        'delivery_id',
        'delivery_uuid',
        'city_id',
        'city_uuid',
        'is_out',
        'qte_global',
        'qte_livre',
        'qte_expidite',
        'qte_endomage',
        'qte_rest',
  
    ];

    protected $casts = [
        'is_out' => 'boolean',
        'is_default' => 'boolean',
        //'sent_at' => 'date:d-m-Y',

    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    
}
