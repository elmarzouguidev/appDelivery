<?php

namespace App\Http\Livewire\Sameleon\Stock\StockDelivery;

use App\Models\Sameleon\Stock;
use App\Repositories\City\CityInterface;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Delivery\DeliveryInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Stock\StockInterface;
use Livewire\Component;

class StockDelivery extends Component
{

    public $stockEdit;
    public $stock;

    public $showEditStock = false;
    public $showDetail = false;

    protected $listeners = [
        'editStock', 'editStock',
        'data:update' => '$refresh',
        'updateStock' => 'updateStock'
    ];

    public function render()
    {

        $stocks = app(StockInterface::class)->getStocksForDelivery();
    
        return view('livewire.sameleon.stock.stock-delivery.stock-delivery', compact('stocks'));
    }
    public function mount()
    {
        $this->emit('refresh');

    }

    public function editStock(Stock $stock)
    {

        $this->showEditStock = true;

        $this->stockEdit = $stock;

        $this->dispatchBrowserEvent('show-edit-stock');
    }

    public function showStockDetail(Stock $stock)
    {
        $this->showDetail = true;

        $this->product = $stock->load('stocks');

        //dd($this->product);

        $this->dispatchBrowserEvent('show-stock-detail');
    }
}
