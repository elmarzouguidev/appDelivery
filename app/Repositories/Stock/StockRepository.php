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

        if (auth()->user()->hasRole('Client')) {

            return $this->stock
                ->where('client_id', auth()->id())
                ->where('client_uuid', auth()->user()->uuid)
                ->with('product:id,name')
                ->with('city:id,name')
                ->get();
        } elseif (auth()->user()->hasRole('DeliveryEntreprise')  && auth()->user()->is_delivery == true) {

            return $this->stock
                ->where('delivery_id', auth()->id())
                ->where('delivery_uuid', auth()->user()->uuid)
                ->where('city_id', auth()->user()->city_id)
                ->where('city_uuid', auth()->user()->city->uuid)
                ->with('product:id,name,price')
                ->get();
        } else {

            return $this->stock->with('client:id,nom,prenom')
                ->with('product:id,name')
                ->with('city:id,name')

                ->get();
        }

        return [];
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
