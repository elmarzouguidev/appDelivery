<?php

namespace App\Http\Livewire\Sameleon\Invoice;

use App\Models\Sameleon\Invoice;
use App\Repositories\Invoice\InvoiceInterface;
use App\Status\InvoiceStatus;
use Livewire\Component;
use Livewire\WithFileUploads;

class Invoices extends Component
{
    use WithFileUploads;

    //public $invoices;

    public $addBiller = false;
    public $invoicer;

    /****Bill ****/

    public $price;
    public $formatedPrice;
    public $date;
    public $mode;
    public $reference;
    public $notes;
    public $recu;

    /****Cloture Invoice */


    public $buttonClass = 'disabled';

    protected $messages = [
        //'recu.required' => "You must use the 'Choose file' button to select which file you wish to upload",
        'recu.max' => "Maximum file size to upload is 1MB (1024 KB)."
    ];

    public function render()
    {

        /*if (auth()->user()->hasRole('Client')) {
            $invoices = Invoice::authClient()
                ->withCount('commands')
                ->withSum('articles', 'price_total')
                ->with('bill')
                ->withCount('bill')
                ->get();
        } else {
            $invoices = Invoice::withCount('commands')
                ->withSum('articles', 'price_total')
                ->with('client:id,nom,prenom')
                ->with('bill')
                ->withCount('bill')
                ->get();  
        }*/

        $invoices = app(InvoiceInterface::class)->getInvoices();
        $this->date = now()->format('m-d-Y');

        return view('livewire.sameleon.invoice.invoices-new', compact('invoices'));
    }

    public function addBill(Invoice $invoice)
    {

        $this->addBiller = true;
        $this->invoicer = $invoice->loadSum('articles', 'price_total')
            ->loadSum('articles', 'frais')
            ->loadSum('articles', 'profit');
        //$this->price = $invoice->articles_sum_price_total;
        $this->price =  ($invoice->articles_sum_price_total - ($invoice->articles_sum_frais + $invoice->articles_sum_profit));
        $this->formatedPrice = number_format($invoice->articles_sum_price_total - ($invoice->articles_sum_frais + $invoice->articles_sum_profit), 2);
        $this->dispatchBrowserEvent('add-bill');
    }

    public function storeBill(Invoice $invoice)
    {
        //dd($this->recu);
        $this->validate();

        $invoice->loadSum('articles', 'price_total');

        $bankAccount = $invoice->client->bank->first() ?? [];

        //dd($bankAccount->name,"##",$bankAccount->account);

        $biller = [

            'bill_date' => $this->date,
            'bill_mode' => $this->mode,
            'reference' => $this->reference,
            'bank_name'  => $bankAccount->name ?? null,
            'bank_rib'   => $bankAccount->account->rib ?? null,
            'notes' => $this->notes,
            'price_ht' => $this->price,
            'price_total' => $this->price,
            'price_tva' => $this->price,
            'client_id' => $invoice->user_id,
            'client_uuid' => $invoice->user_uuid,
        ];

        $bill = $invoice->bill()->create($biller);

        $invoice->update(['cloture' => true, 'status' => InvoiceStatus::PAYEE]);

        if ($this->recu) {

            $bill->addMedia($this->recu)->toMediaCollection('bills_recu');
        }
        $this->recu = null;
        //return redirect(route('commercial:bills.index'))->with('success', "Le règlement  a éte ajouter avec success");
        $this->dispatchBrowserEvent('invoice-paid');
    }

    public function updatedRecu()
    {
        if ($this->recu && $this->recu->temporaryUrl()) {
            $this->buttonClass = '';
        }
    }

    public function clotureInvoice(Invoice $invoice)
    {
        $invoice->update(['cloture' => !$invoice->cloture]);

        $this->dispatchBrowserEvent('reloadbrowser');
    }


    /*** Validation Rules  ***/
    protected function rules()
    {

        return [

            'price' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'mode' => ['required', 'string'],
            'reference' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'recu' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:1024'],
        ];
    }
}
