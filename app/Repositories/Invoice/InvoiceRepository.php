<?php


namespace App\Repositories\Invoice;

use App\Models\Sameleon\Invoice;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class InvoiceRepository extends AppRepository implements InvoiceInterface
{

    private $invoice;

    private $instance;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function __instance(): Invoice
    {
        if (!$this->instance) {
            $this->instance = $this->invoice;
        }

        return $this->instance;
    }

    /**
     * @return Invoice[]|Collection|string[]
     */
    public function getInvoices()
    {

        if (auth()->user()->hasRole('Client')) {

            return $this->invoice
                ->authClient()
                ->withCount('commands')
                ->withSum('articles', 'price_total')
                ->with('bill')
                ->withCount('bill')
                ->get();
        } else {

            return $this->invoice
                ->withCount('commands')
                ->withSum('articles', 'price_total')
                ->with('bill')
                ->withCount('bill')

                ->get();
        }
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
