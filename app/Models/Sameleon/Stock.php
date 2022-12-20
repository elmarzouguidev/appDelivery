<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\HasCode;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Stock extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;
    use HasCode;

    protected $fillable = [
        'uuid',
        'is_default',
        'is_client',
        'is_delivery',
        'code',
        'client_id',
        'client_uuid',
        'product_id',
        'product_uuid',
        'delivery_id',
        'delivery_uuid',
        'city_id',
        'city_uuid',
        'is_out',
        'qte_global',
        'qte_livre',
        'qte_expidite',
        'qte_endomage',
        'qte_rest',
        'qte_alert',
        'notes',
        'sent_at',
        'active',
    ];

    protected $casts = [
        'is_out' => 'boolean',
        'is_default' => 'boolean',
        'is_client' => 'boolean',
        'is_delivery' => 'boolean',
        //'sent_at' => 'date:d-m-Y',

    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getAdjustmentDateAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->sent_at);

        return $date->translatedFormat('d').' '.$date->translatedFormat('F').' '.$date->translatedFormat('Y');
    }

    public function scopeProductFilters(Builder $query, $product): Builder
    {
        return  $query->where('product_id', $product);
    }

    public function scopeCitiesFilters(Builder $query, $city): Builder
    {
        return $query->where('city_id', $city);
    }

    public function scopeDeliveryFilters(Builder $query, $delivery): Builder
    {
        return $query->where('delivery_id', $delivery);

        /***** */
    }

    public function scopeClientFilters(Builder $query, $client): Builder
    {
        return $query->where('client_id', $client);

        /***** */
    }

    public function scopeQteFilters(Builder $query, $qte): Builder
    {
        return $query->where('qte_rest', $qte);

        /***** */
    }

    public function scopeAlertsFilters(Builder $query, $qte): Builder
    {
        return $query->where('qte_alert', $qte);

        /***** */
    }
}
