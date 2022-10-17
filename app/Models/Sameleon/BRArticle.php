<?php

namespace App\Models\Sameleon;

use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BRArticle extends Model
{
    use HasFactory;

    use UuidGenerator;

    protected $fillable = [
        'uuid',
        'b_router_id',
        'b_router_uuid',
        'command_id',
        'command_uuid',
        'command_status',
        'email',
        'phone',
        'name',
        'address',
        'comment',
        'price_total',
        'bon_date'
    ];

    protected  $casts = [
        'bon_date' => 'date',
        'price_total' => 'float',
        'command_status' => 'integer'
    ];

    public function bon()
    {
        return $this->belongsTo(BRouter::class, 'b_router_id');
    }

    public function command()
    {
        return $this->belongsTo(Command::class);
    }

    public function getFormatedPriceTotalAttribute()
    {
        return number_format($this->price_total, 2);
    }
}
