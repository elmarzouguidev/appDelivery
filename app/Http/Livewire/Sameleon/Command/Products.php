<?php

namespace App\Http\Livewire\Sameleon\Command;

use Livewire\Component;

class Products extends Component
{
    public $products = [];

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

    public function removeProduct($index)
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }
}
