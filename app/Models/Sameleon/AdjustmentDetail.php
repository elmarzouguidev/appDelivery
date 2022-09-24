<?php

namespace App\Models\Sameleon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'product_id', 'adjustment_id', 'quantity', 'type',
    ];

    protected $casts = [
        'adjustment_id' => 'integer',
        'product_id' => 'integer',
        //'quantity' => 'double',
    ];

    public function adjustment()
    {
        return $this->belongsTo(Adjustment::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
