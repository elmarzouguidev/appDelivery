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
        'addresse',
        'product_id',
        'product_uuid',
        'client_id',
        'client_uuid',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
