<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    protected $fillable = [
        'uuid',
        'user_id',
        'content',
        'approved',
        'rating'
    ];

    protected  $casts = [
        'approved' => 'boolean'
    ];

    public function client()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
