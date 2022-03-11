<?php

namespace App\Models\Sameleon;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website',
        'logo',
        'city',
        'addresse',
        'telephone',
        'email',
        'rc',
        'ice',
        'cnss',
        'patente',
        'if',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
