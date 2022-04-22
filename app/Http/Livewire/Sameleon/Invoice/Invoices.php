<?php

namespace App\Http\Livewire\Sameleon\Invoice;

use App\Models\Sameleon\Invoice;
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

    public function render()
    {

        if (auth()->user()->hasRole('Client')) {
            $invoices = Invoice::authClient()
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
            //dd($invoices);   
        }
        return view('livewire.sameleon.invoice.invoices', compact('invoices'));
    }

    public function addBill(Invoice $invoice)
    {

        $this->addBiller = true;
        $this->invoicer = $invoice->loadSum('articles', 'price_total');
        $this->price = $invoice->articles_sum_price_total;
        $this->dispatchBrowserEvent('add-bill');
    }

    public function storeBill(Invoice $invoice)
    {
        //dd($this->recu);
        $this->validate();

        $invoice->loadSum('articles', 'price_total');

        $biller = [

            'bill_date' => $this->date,
            'bill_mode' => $this->mode,
            'reference' => $this->reference,
            'notes' => $this->notes,
            'price_ht' => $invoice->articles_sum_price_total,
            'price_total' => $invoice->articles_sum_price_total,
            'price_tva' => $invoice->articles_sum_price_total,
        ];

        $bill = $invoice->bill()->create($biller);

        $invoice->update(['cloture' => true]);

        if ($this->recu) {

            $bill->addMedia($this->recu)->toMediaCollection('bills_recu');
        }
        $this->recu = null;
        //return redirect(route('commercial:bills.index'))->with('success', "Le règlement  a éte ajouter avec success");
        $this->dispatchBrowserEvent('invoice-paid');
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
            
            'price' => ['required', 'numeric', 'digits_between:1,20'],
            'date' => ['required', 'date'],
            'mode' => ['required', 'string'],
            'reference' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'recu' => ['nullable', 'file', 'mimes:png,jpg,jpeg'],

        ];
    }
}
