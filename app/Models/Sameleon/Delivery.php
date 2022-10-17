<?php

namespace App\Models\Sameleon;

use App\Status\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;

class Delivery extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;
    use HasRoles;

    protected $table = 'deliveries';

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'cnie',
        'addresse',
        'city',
        'active',
        'parent_id',
        'parent_uuid',
        'city_uuid',
        'city_id',
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

    public function completProfile()
    {

        return  is_null($this->attributes['cnie']) ||
            is_null($this->attributes['addresse']) ||
            is_null($this->attributes['telephone']) ? false : true;
    }

    public function commands()
    {
        return $this->hasMany(Command::class, 'delivery_id')->orderBy('created_at', 'ASC');
    }

    public function blivraisons()
    {
        return $this->hasMany(BLivraison::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function DeliveryCompany()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**** */

    public function commandsDelivery()
    {
        return $this->hasMany(Command::class, 'delivery_id');
    }

    public function getDeliveryTotalDayChiffreAttribute()
    {
        $commands =  $this->commandsDelivery()
            ->where('status', Status::LIVRE)
            ->whereDate('delivered_at', now()->format('Y-m-d'))
            ->withSum('items', 'prix_total')
            ->get();

        $total = collect($commands)->sum('items_sum_prix_total');

        return number_format($total, 2);
    }
    
    public function getDeliveryTotalChiffreAttribute()
    {
        $commands =  $this->commandsDelivery()
            ->where('status', Status::LIVRE)
            //->whereDate('delivered_at', now()->format('Y-m-d'))
            ->withSum('items', 'prix_total')
            ->get();

        $total = collect($commands)->sum('items_sum_prix_total');

        return number_format($total, 2);
    }

    public function regions()
    {
        return $this->hasMany(Region::class, 'delivery_id');
    }
}
