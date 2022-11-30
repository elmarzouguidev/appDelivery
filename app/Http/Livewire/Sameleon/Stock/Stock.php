<?php

namespace App\Http\Livewire\Sameleon\Stock;

use App\Models\Sameleon\Product;
use App\Models\Sameleon\Stock as SameleonStock;
use App\Repositories\City\CityInterface;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Delivery\DeliveryInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Stock\StockInterface;
use Livewire\Component;

class Stock extends Component
{

    public $stockEdit;
    public $stock;

    public $showEditStock = false;
    public $showDetail = false;

    protected $listeners = ['editStock', 'editStock'];

    public function render()
    {

        $deliveries = app(DeliveryInterface::class)->getDeliveryEntreprise();
        $cities = app(CityInterface::class)->getCities();
        $products = app(ProductInterface::class)->getProducts();

        $stocks = app(StockInterface::class)->getStocks();
        $clients = app(ClientInterface::class)->getClients();

        return view('livewire.sameleon.stock.stock-new', compact('stocks', 'products', 'cities', 'deliveries', 'clients'));
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
