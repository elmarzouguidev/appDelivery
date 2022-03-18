<?php

namespace App\Models\Sameleon;

use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use UuidGenerator;

    protected $fillable = [
        
        'content',
        'user_id',
        'client_id',
        'uuid',
        'reported_at'
    ];

    protected $casts = [
        'reported_at' => 'datetime',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
