<?php

namespace App\Http\Livewire\Sameleon\Stock\StockDelivery;

use App\Filters\ItemsQuery;
use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\Stock;
use App\Repositories\City\CityInterface;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Delivery\DeliveryInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Stock\StockInterface;
use Livewire\Component;
use Livewire\WithPagination;

class StockDelivery extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $stockEdit;
    public $stock;

    public $showEditStock = false;
    public $showDetail = false;


    public $filter = [];

    public $data = [];

    protected $updatesQueryString = ['filter'];

    protected $listeners = [
        'editStock', 'editStock',
        'data:update' => '$refresh',
        'updateStock' => 'updateStock'
    ];

    public function render()
    {

        $stock = new ItemsQuery(new Stock(), $this->filter);

        $stocks = $stock
            ->whereIsDefault(false)
            ->whereNotNull('delivery_id')
            ->whereNotNull('delivery_uuid')
            ->with('client:id,uuid,nom,prenom')
            ->with('product:id,uuid,name,price')
            ->with('city:id,name')
            ->with('delivery:id,uuid,nom,prenom')
            ->get()
            ->sortBy(function ($query) {
                return optional($query->client)->prenom;
            })
            ->paginate(10);

        $delivries = Delivery::role(['DeliveryEntreprise'])->select(['uuid', 'id', 'nom', 'prenom', 'type'])->get();
        $citiesList = app(CityInterface::class)->getCities();
        $products = app(ProductInterface::class)->getProducts();
        $clients = app(ClientInterface::class)->getClients();

        return view('livewire.sameleon.stock.stock-delivery.stock-delivery', compact('stocks', 'delivries', 'citiesList', 'products', 'clients'));
    }
    public function mount()
    {
        $this->emit('refresh');
    }

    public function editStock(Stock $stock)
    {

        $this->showEditStock = true;

        $this->stockEdit = $stock->load('delivery','product','client');

        $this->dispatchBrowserEvent('show-edit-stock');
    }

    public function showStockDetail(Stock $stock)
    {
        $this->showDetail = true;

        $this->product = $stock->load('stocks');

        //dd($this->product);

        $this->dispatchBrowserEvent('show-stock-detail');
    }

    /********************Filters **************************/

    public function setfilter()
    {

        if (!$this->data) {

            return;
        }

        $this->data = array_filter(array_map('trim', $this->data));

        $this->filter = $this->data;

        $this->emit('refresh');
    }

    public function resetfilter()
    {
        $this->data = null;

        $this->emit('refresh');
    }
}
