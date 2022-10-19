<?php


namespace App\Repositories\Invoice;

use App\Models\Sameleon\DeliveryInvoice;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class DeliveryInvoiceRepository extends AppRepository implements DeliveryInvoiceInterface
{

    private $invoice;

    private $instance;

    public function __construct(DeliveryInvoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function __instance(): DeliveryInvoice
    {
        if (!$this->instance) {
            $this->instance = $this->invoice;
        }

        return $this->instance;
    }

    /**
     * @return DeliveryInvoice[]|Collection|string[]
     */
    public function getInvoices()
    {

            return $this->invoice
                ->withCount('commands')
                ->withSum('articles', 'price_total')
                //->with('bill')
                //->withCount('bill')

                ->get();
        
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getInvoice(int $id)
    {
        return $this->invoice->find($id);
    }


    public function getInvoiceByUuid(string $uuid)
    {
        return $this->invoice->whereUuid($uuid);
    }

    public function getInvoiceById(int $id)
    {
        return $this->invoice->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->invoice->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->invoice->first();
    }
}
