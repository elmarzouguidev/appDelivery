<?php

namespace App\Models\Sameleon;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;

class Delivery extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    protected $table = 'sub_deliveries';

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'cnie',
        'city',
        'active',
        'user_id',
        'user_uuid'
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
        'active' => 'boolean',

    ];

    public $guard_name = 'delivery';

    protected function fullName(): Attribute
    {
        return new Attribute(
            fn () => $this->nom . ' ' . $this->prenom,
        );
    }

    public function isActive()
    {
        return $this->active ? true : false;
    }

    public function commands()
    {
        return $this->hasMany(Command::class, 'sub_delivery_id')->orderBy('created_at', 'ASC');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function DeliveryCompany()
    {
        return $this->belongsTo(User::class);
    }
}
