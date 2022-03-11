<?php

namespace App\Models\Sameleon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Comment extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'content',
        'user_id',
        'uuid'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
