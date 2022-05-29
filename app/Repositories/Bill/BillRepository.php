<?php


namespace App\Repositories\Bill;

use App\Models\Sameleon\Bill;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class BillRepository extends AppRepository implements BillInterface
{

    private $bill;

    private $instance;

    private $options;

    public function __construct(Bill $bill)
    {
        $this->bill = $bill;

        $this->options = config('app-config');
    }

    public function __instance(): Bill
    {
        if (!$this->instance) {
            $this->instance = $this->bill;
        }

        return $this->instance;
    }


    /**
     * @return Bill[]|Collection|string[]
     */
    public function getBills()
    {
        if ($this->useCache()) {
            // dd('yes cache');
            return $this->setCache()->remember('all_bills_cache', $this->timeToLive(), function () {

                return $this->bill->get();
            });
        }
        //dd('no cache');
        return $this->bill->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getBill(int $id)
    {
        return $this->bill->find($id);
    }


    public function getBillByUuid(string $uuid)
    {
        return $this->bill->whereUuid($uuid);
    }

    public function getBillById(int $id)
    {
        return $this->bill->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->bill->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->bill->first();
    }
}
