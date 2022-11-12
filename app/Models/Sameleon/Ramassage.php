<?php

namespace App\Models\Sameleon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;

class Ramassage extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    protected $fillable = [
        'uuid',
        'name',
        'price',
        'qte',
        'addresse',
        'notes',
        'active',
        'user_id',
        'user_uuid',
        'product_id',
        'product_uuid',
        'category_id',
        'accepted'
    ];

    protected $casts = [
        'active' => 'boolean',
        'accepted'=>'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
