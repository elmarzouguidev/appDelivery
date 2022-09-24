<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCity extends Model
{
    use HasFactory;

    use UuidGenerator;
    use GetModelByUuid;
    
    protected $table = 'product_cities';

    protected $fillable = [
        'product_id', 'city_id', 'qte',
    ];

    protected $casts = [
        'product_id' => 'integer',
        'city_id' => 'integer',
        //'qte' => 'double',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
