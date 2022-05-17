<?php

namespace App\Models\Sameleon;

use App\Notifications\Sameleon\ResetPasswordNotification;
use App\Status\Status;
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
        'type',
        'active',
        'is_completed'
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
        'active' => 'boolean',
        'is_completed' => 'boolean',
    ];


    public $guard_name = 'admin';

    protected function fullName(): Attribute
    {
        return new Attribute(
            fn () => $this->nom . ' ' . $this->prenom,
        );
    }

    public function completProfile()
    {
        if (auth()->user()->hasRole('Client') && auth()->user()->type == 'particulier') {
            return  is_null($this->attributes['cnie']) ||
                is_null($this->attributes['addresse']) ||
                is_null($this->attributes['telephone']) ? false : true;
        } else {
            return true;
        }
    }

    public function isActive()
    {
        if (auth()->user()->hasRole('Client')) {
            return $this->active ? true : false;
        } else {
            return true;
        }
    }

    public function group()
    {
        return $this->hasOne(Group::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function commands()
    {
        if (auth()->user()->hasAnyRole('Client', 'Admin', 'SuperAdmin')) {
            return $this->hasMany(Command::class)->orderBy('created_at', 'ASC');
        } elseif (auth()->user()->hasRole('Delivery')) {
            return $this->hasMany(Command::class, 'delivery_id')->where('delivery_id', auth()->id())->orderBy('created_at', 'ASC');
        }
    }

    public function commandsDelivery()
    {
        return $this->hasMany(Command::class, 'delivery_id');
    }

    public function commandsDeliverySum()
    {
        return $this->hasMany(Command::class, 'delivery_id')
            ->where('status', Status::LIVRE)
            ->whereDay('delivered_at', now()->format('d'))
            ->withSum('items', 'prix_total');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class)->orderBy('created_at', 'DESC');;
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function regions()
    {
        return $this->hasMany(Region::class, 'delivery_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }

    public function scopeWithLastLogin($query)
    {
        return $query->addSelect([
            'last_logged_in_id' => UserLogin::select('id')
                ->whereColumn('user_id', 'users.id')
                ->where('user_id', $this->id)
                ->orderBy('logged_in_at', 'desc')
                ->limit(1),
        ])->with(['lastLogin'])->first();
    }

    //https://laravel.com/docs/8.x/collections#method-pop
    public function GetLoginHistory()
    {
        $sessionsAll = $this->loginHistory()->get() ?? [];
        $sessionsAll->pop(); //remove las login because it's getted from scopeWithLastLogin() function
        return collect($sessionsAll->all());
    }

    public function lastLogin()
    {
        return $this->belongsTo(UserLogin::class, 'last_logged_in_id');
    }

    public function loginHistory()
    {
        return $this->hasMany(UserLogin::class);
    }


    /*****Notifications */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public static function boot()
    {
        parent::boot();

        $prefixer = "client-";

        static::creating(function ($model) use ($prefixer) {

            $number = (self::max('id') + 1);

            if ($model->is_admin) {
                $prefixer = "_admin_";
            }

            $model->code = $prefixer . str_pad($number, 5, 0, STR_PAD_LEFT);
        });
    }
}
