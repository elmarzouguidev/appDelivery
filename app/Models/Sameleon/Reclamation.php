<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\HasCode;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;
    use HasCode;

    protected $fillable = ['message','active','status','uuid','code'];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function command()
    {
        return $this->belongsTo(Command::class);
    }
}
