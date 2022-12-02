<?php


namespace App\Repositories\Stock;


use App\Models\Sameleon\Stock;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class StockRepository extends AppRepository implements StockInterface
{

    private $stock;

    private $instance;

    private $options;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;

        $this->options = config('app-config');
    }

    public function __instance(): Stock
    {
        if (!$this->instance) {
            $this->instance = $this->stock;
        }

        return $this->instance;
    }

    /**
     * @return Stock[]|Collection|string[]
     */
    public function getStocks()
    {

        if (isClient()) {

            return $this->stock
                ->whereIsDefault(true)
                ->where('client_id', auth()->id())
                ->where('client_uuid', auth()->user()->uuid)
                ->with('product:uuid,id,name,price')
                ->with('city:uuid,id,name')
                ->get();
        } elseif (isDelivery() && delivery()->hasRole('DeliveryEntreprise')) {

            return $this->stock
                ->where('delivery_id', delivery()->id)
                ->where('delivery_uuid', delivery()->uuid)
                ->where('city_id', delivery()->city?->id)
                ->where('city_uuid', delivery()->city?->uuid)
                ->with('product:id,name,price')
                ->get();
        } else {

            return $this->stock
                ->whereIsDefault(true)
                ->whereNull('delivery_id')
                ->whereNull('delivery_uuid')
                ->with('client:id,uuid,nom,prenom')
                ->with('product:id,uuid,name,price')
                ->with('city:id,name')
                ->get()
                ->sortBy(function ($query) {
                    return optional($query->client)->prenom;
                })
                ->all();
        }

        return [];
    }

    public function getStocksForDelivery()
    {
        return $this->stock
            ->whereIsDefault(false)
            ->whereNotNull('delivery_id')
            ->whereNotNull('delivery_uuid')
            ->with('client:id,uuid,nom,prenom')
            ->with('product:id,uuid,name,price')
            ->with('city:id,name')
            ->with('delivery:id,uuid,nom,prenom')
            ->get()
            ->sortBy(function ($query) {
                return optional($query->client)->prenom;
            })
            ->all();
    }
    /**
     * @param int $id
     * @return mixed
     */
    public function getStock(int $id)
    {
        return $this->stock->find($id);
    }


    public function getStockByUuid(string $uuid)
    {
        return $this->stock->whereUuid($uuid);
    }

    public function getStockById(int $id)
    {
        return $this->stock->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->stock->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->stock->first();
    }
}
