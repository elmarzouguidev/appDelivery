<?php

namespace App\Models;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use GetModelByUuid;
    use UuidGenerator;

    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];


    public $guard_name = 'admin';

    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function boot()
    {
        parent::boot();

        $prefixer = "CLT-";

        static::creating(function ($model) use ($prefixer) {

            $number = (self::max('id') + 1);
            if ($model->is_admin) {
                $model->code = "ADMIN-" . str_pad($number, 5, 0, STR_PAD_LEFT);
            } else {
                $model->code = $prefixer . str_pad($number, 5, 0, STR_PAD_LEFT);
            }
        });
    }
}
