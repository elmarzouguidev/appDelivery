<?php


namespace App\Repositories\Delivery;

use App\Models\Sameleon\User;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class DeliveryRepository extends AppRepository implements DeliveryInterface
{

    private $delivery;

    private $instance;

    public function __construct(User $delivery)
    {
        $this->delivery = $delivery;
    }

    public function __instance(): User
    {
        if (!$this->instance) {
            $this->instance = $this->delivery;
        }

        return $this->instance;
    }

    /**
     * @return User[]|Collection|string[]
     */
    public function getDeliveries()
    {
        if ($this->useCache()) {
            return $this->setCache()->remember('all_deliveries_cache', $this->timeToLive(), function () {
                return $this->delivery->role(['Delivery', 'DeliveryEntreprise'])->get();
            });
        } else {

            return $this->delivery->role(['Delivery', 'DeliveryEntreprise'])->get();
        }
        return [];
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
