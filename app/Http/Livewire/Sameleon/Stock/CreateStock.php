<?php

namespace App\Http\Livewire\Sameleon\Stock;

use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\Product;
use App\Repositories\City\CityInterface;
use App\Repositories\Client\ClientInterface;
use Livewire\Component;

class CreateStock extends Component
{
    public $delivery;

    public $client;

    public $city;

    public $product;

    public $deliveries;

    public $products;

    public function hydrate()
    {
        $this->emit('datatable');
    }

    public function render()
    {
        $cities = app(CityInterface::class)->getCities();

        $clients = app(ClientInterface::class)->getClients();

        return view('livewire.sameleon.stock.create-stock', compact('cities', 'clients'));
    }

    public function mount()
    {
        $this->emit('refresh');

        $this->city = null;
        $this->client = null;

        $this->deliveries = [];
        $this->products = [];

        $this->delivery = null;
    }

    public function updatedCity()
    {
        $deliveryy = Delivery::whereCityId($this->city)->get();
        $this->deliveries = $deliveryy;
        // dd($this->deliveries,$this->city);
    }

    public function updatedClient($value)
    {
        $this->products = Product::whereUserUuid($value)->get();
    }
}
