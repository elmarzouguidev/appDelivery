<?php

namespace App\Http\Livewire\Sameleon\Command;

use Livewire\Component;
use Illuminate\Support\Arr;

class Products extends Component
{

    protected $listeners = [
        //'selectedProduct',
    ];

    public $products = [];

    public $totalPrice ;

    public $orderProducts = [];

    public function mount()
    {
        $this->products = auth()->user()->products()->get();
        $this->orderProducts = [
            [
                'product_id' => '',
                'quantity' => 1,
                'designation' => '',
                'description' => '',
                'prix_unitaire' => ''
            ]
        ];
        $this->totalPrice = 0;
    }

    public function render()
    {
        return view('theme.livewire.sameleon.command.products');
    }

    public function addProduct()
    {
        $this->orderProducts[] = [
            'product_id' => '',
            'quantity' => 1,
            'designation' => '',
            'description' => '',
            'prix_unitaire' => ''
        ];
    }

    /*public function selectedProduct($product)
    {
        //dd($product,'##',$indexer);
       $this->pricer =  $this->products->firstWhere('id', $product)->price;
    }*/

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
