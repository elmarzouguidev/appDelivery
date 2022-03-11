<?php

namespace App\Models;

use App\Models\Sameleon\Command;
use App\Models\Sameleon\Company;
use App\Models\Sameleon\Product;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'is_admin',
        'cnie',
        'addresse',
        'city',
        'type'
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
        'is_admin' => 'boolean',
        'active' => 'boolean'
    ];


    public $guard_name = 'admin';

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected function fullName(): Attribute
    {
        return new Attribute(
            fn () => $this->nom . ' ' . $this->prenom,
        );
    }

    public static function boot()
    {
        parent::boot();

        $prefixer = "CLT-";

        static::creating(function ($model) use ($prefixer) {

            $number = (self::max('id') + 1);
            if ($model->is_admin) {
                $model->code = "__-" . str_pad($number, 5, 0, STR_PAD_LEFT);
            } else {
                $model->code = $prefixer . str_pad($number, 5, 0, STR_PAD_LEFT);
            }
        });
    }
}
