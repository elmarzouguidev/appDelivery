<?php

namespace App\Http\Livewire\Sameleon\Stock;

use App\Models\Sameleon\Stock as SameleonStock;
use App\Repositories\City\CityInterface;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Stock\StockInterface;
use Livewire\Component;

class Stock extends Component
{
    public $stockEdit;

    public $stock;

    public $showEditStock = false;

    public $showDetail = false;

    public $delivery;

    public $client;

    public $stockCity;

    public $product;

    public $deliveries;

    protected $listeners = [
        'data:update' => '$refresh',
    ];

    public function render()
    {
        $cities = app(CityInterface::class)->getCities();
        $products = app(ProductInterface::class)->getProducts();

        $stocks = app(StockInterface::class)->getStocks();
        $clients = app(ClientInterface::class)->getClients();

        return view('livewire.sameleon.stock.stock-new', compact('stocks', 'products', 'cities', 'clients'));
    }

    public function mount()
    {
        $this->emit('refresh');

        $this->stockCity = null;

        $this->deliveries = [];

        $this->delivery = null;
    }

    public function editStock(SameleonStock $stock)
    {
        $this->showEditStock = true;

        $this->stockEdit = $stock;

        $this->dispatchBrowserEvent('show-edit-stock');
    }

    public function showStockDetail(SameleonStock $stock)
    {
        $this->showDetail = true;

        $this->product = $stock->load('stocks');

        //dd($this->product);

        $this->dispatchBrowserEvent('show-stock-detail');
    }
}
