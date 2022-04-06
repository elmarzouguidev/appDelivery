<?php

namespace App\Http\Livewire\Sameleon\Invoice;

use App\Models\Sameleon\Invoice;
use Livewire\Component;

class Invoices extends Component
{
    //public $invoices;

    public $addBiller = false;
    public $invoicer;

    /****Bill ***/

    public $price;
    public $date;
    public $mode;
    public $reference;
    public $notes;

    public function render()
    {

        if (auth()->user()->hasRole('Client')) {
            $invoices = Invoice::authClient()->get();
        } else {
            $invoices = Invoice::withCount('commands')
                ->withSum('articles', 'price_total')
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
        // $validatedData = $this->validate();
        //dd('Ouii  Im here', $validatedData);

        //$this->authorize('create', Bill::class);

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

        $invoice->bill()->create($biller);

        $invoice->update(['cloture' => true]);

        //return redirect(route('commercial:bills.index'))->with('success', "Le règlement  a éte ajouter avec success");
        $this->dispatchBrowserEvent('invoice-paid');
    }

    /*public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }*/


    /*** Validation Rules  ***/
    protected function rules()
    {

        return [
            'price' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'mode' => ['required', 'string'],
            'reference' => ['nullable', 'string'],
            'notes' => ['nullable', 'string']

        ];
    }
}
