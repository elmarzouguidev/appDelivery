<?php

namespace App\Http\Livewire\Sameleon\Command;

use App\Models\Sameleon\Product;
use Livewire\Component;
use Illuminate\Support\Arr;

class Products extends Component
{

    protected $listeners = [
        //'selectedProduct',
    ];

    public $products = [];

    public $totalPrice;

    public $orderProducts = [];

    public function mount()
    {

        $this->orderProducts = [
            [
                'product_id' => '',
                'quantity' => 1,
                'designation' => '',
                'description' => '',
                'prix_unitaire' => '',
                'readonly' => ''
            ]
        ];
        $this->totalPrice = 0;

        if (auth('client')->check()) {
            $this->products = auth()->user()->products()->get();
        } else {
            $this->products = Product::with('media')->get();
        }
    }

    public function render()
    {
        return view('livewire.sameleon.command.products');
    }

    public function addProduct()
    {
        //$data = collect($this->orderProducts);

        // $this->products = auth()->user()->products()->get()->diffKeys($data);

        $this->orderProducts[] = [
            'product_id' => '',
            'quantity' => 1,
            'designation' => '',
            'description' => '',
            'prix_unitaire' => '',
            'readonly' => ''
        ];
    }

    public function getPrice($index)
    {

        if ($this->orderProducts[$index]['product_id'] !== "") {
            $this->orderProducts[$index]['prix_unitaire'] =  $this->products->firstWhere('id', $this->orderProducts[$index]['product_id'])->price;
        }
    }

    public function removeProduct($index)
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }
}
