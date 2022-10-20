<?php

namespace App\Http\Livewire\Sameleon\Invoice\SubDelivery;

use App\Models\Sameleon\DeliveryInvoice;
use App\Repositories\Invoice\DeliveryInvoiceInterface;
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
    public $date;
    public $mode;
    public $reference;
    public $notes;
    public $recu;

    /****Cloture Invoice */

    public $cloture = false;


    public $buttonClass = 'disabled';

    protected $messages = [
        //'recu.required' => "You must use the 'Choose file' button to select which file you wish to upload",
        'recu.max' => "Maximum file size to upload is 1MB (1024 KB)."
    ];

    public function render()
    {

        $invoices = app(DeliveryInvoiceInterface::class)->getInvoices();

        return view('livewire.sameleon.invoice.sub-delivery.invoices',compact('invoices'));
    }

    public function addBill(DeliveryInvoice $invoice)
    {

        $this->addBiller = true;
        $this->invoicer = $invoice->loadSum('articles', 'price_total')
        ->loadSum('articles','frais')
        ->loadSum('articles','profit');
        //$this->price = $invoice->articles_sum_price_total;
        $this->price =  number_format($invoice->articles_sum_price_total -($invoice->articles_sum_frais + 0),2);

        $this->dispatchBrowserEvent('add-bill');
    }

    public function storeBill(DeliveryInvoice $invoice)
    {
        //dd($this->recu);
        $this->validate();

        $invoice->loadSum('articles', 'price_total');

        $biller = [

            'bill_date' => $this->date,
            'bill_mode' => $this->mode,
            'reference' => $this->reference,
            'notes' => $this->notes,
            'price_ht' => $this->price,
            'price_total' => $this->price,
            'price_tva' => $this->price,
            'delivery_id' => $invoice->delivery_id,
            'delivery_uuid' => $invoice->delivery_uuid,
        ];

        $bill = $invoice->bill()->create($biller);

        $invoice->update(['cloture' => true]);

        if ($this->recu) {

            $bill->addMedia($this->recu)->toMediaCollection('bills_delivery_recu');
        }
        $this->recu = null;
        //return redirect(route('commercial:bills.index'))->with('success', "Le règlement  a éte ajouter avec success");
        $this->dispatchBrowserEvent('invoice-paid');
    }

    public function updatedRecu()
    {
        if($this->recu && $this->recu->temporaryUrl())
        {
            $this->buttonClass ='';
        }
    }

    public function clotureInvoice(DeliveryInvoice $invoice)
    {
        $invoice->update(['cloture' => !$invoice->cloture]);

        $this->dispatchBrowserEvent('reloadbrowser');
    }


    /*** Validation Rules  ***/
    protected function rules()
    {

        return [

            'price' => ['required', 'numeric', 'digits_between:1,20'],
            'date' => ['required', 'date'],
            'mode' => ['required', 'string'],
            'reference' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'recu' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:1024'],
        ];
    }
}
