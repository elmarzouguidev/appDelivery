<?php


namespace App\Repositories\Delivery;

use App\Models\Sameleon\Delivery;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class DeliveryRepository extends AppRepository implements DeliveryInterface
{

    private $delivery;

    private $instance;

    public function __construct(Delivery $delivery)
    {
        $this->delivery = $delivery;
    }

    public function __instance(): Delivery
    {
        if (!$this->instance) {
            $this->instance = $this->delivery;
        }

        return $this->instance;
    }

    /**
     * @return Delivery[]|Collection|string[]
     */
    public function getDeliveries()
    {

        if (isDelivery() && delivery()->hasRole('DeliveryEntreprise')) {
            
            return $this->delivery->role(['SubDelivery'])
                ->whereParentId(auth()->id())
                ->whereParentUuid(auth()->user()->uuid)
                ->get();
        }

        return $this->delivery->role(['Delivery', 'DeliveryEntreprise'])->with('childrens','city:id,name')->get();
            
    }

    public function getDeliveryEntreprise()
    {

        return $this->delivery->role(['DeliveryEntreprise'])->with('childrens')->get(); 
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDelivery(int $id)
    {
        return $this->delivery->find($id);
    }


    public function getDeliveryByUuid(string $uuid)
    {
        return $this->delivery->whereUuid($uuid);
    }

    public function getDeliveryById(int $id)
    {
        return $this->delivery->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->delivery->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->delivery->first();
    }
}
