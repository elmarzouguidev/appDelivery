<?php

namespace App\Http\Livewire\Sameleon\Stock;

use App\Models\Sameleon\Stock as SameleonStock;
use Livewire\Component;

class Stock extends Component
{

    public function render()
    {
        if (auth()->user()->hasRole('Client')) {

            $stocks = SameleonStock::whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->with('product')
                ->get();
        } else {

            $stocks = SameleonStock::with('product')->get();
        }
        return view('livewire.sameleon.stock.stock', compact('stocks'));
    }
}
