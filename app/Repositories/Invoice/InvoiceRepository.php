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

        if (isClient()) {

            return $this->invoice
                ->authClient()
                ->withCount('commands')
                ->withSum('articles', 'price_total')
                ->withSum('articles', 'frais')
                ->withSum('articles', 'profit')
                ->with('bill')
                ->withCount('bill')
                ->orderBy('cloture','asc')
                ->get();
        } else {

            return $this->invoice
                ->withCount('commands')
                ->withSum('articles', 'price_total')
                ->withSum('articles', 'frais')
                ->withSum('articles', 'profit')
                ->with('bill')
                ->withCount('bill')
                ->orderBy('cloture','asc')
                ->get()
                ->sortBy(function ($query) {
                    return optional($query->client)->prenom;
                })
                ->all();
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
