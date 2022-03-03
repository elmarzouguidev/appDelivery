<?php

namespace App\Models\Sameleon;

use App\Models\User;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    public function client()
    {
        return $this->belongs(User::class,'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_command','command_id','product_id');
    }
}
