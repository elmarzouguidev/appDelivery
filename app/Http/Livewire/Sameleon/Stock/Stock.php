<?php

namespace App\Http\Livewire\Sameleon\Stock;

use App\Models\Sameleon\Product;
use App\Models\Sameleon\Stock as SameleonStock;
use Livewire\Component;

class Stock extends Component
{

    public $stockEdit;

    public $showEditStock = false;

    protected $listeners = ['editStock', 'editStock'];

    public function render()
    {
        if (auth()->user()->hasRole('Client')) {

            $stocks = Product::whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->get();
        } else {

            $stocks = Product::with('client')->get();
        }
        return view('livewire.sameleon.stock.stock-new', compact('stocks'));
    }

    public function editStock(Product $stock)
    {
        
        $this->showEditStock = true;

        $this->stockEdit = $stock;

        $this->dispatchBrowserEvent('show-edit-stock');
    }
}
