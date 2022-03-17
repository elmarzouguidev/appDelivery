<?php

namespace App\Http\Livewire\Sameleon\Command;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.sameleon.command.edit');
    }

    protected $listeners = [
        //'selectedProduct',
    ];

    public $command;
    public $products = [];

    public $newOrderProducts = [];
    public $orderProducts;

    public function mount()
    {
        $this->products = auth()->user()->products()->get();

        $this->orderProducts = $this->command->products()->get();

        $this->newOrderProducts = [
            [
                'product_id' => '',
                'quantity' => 1,
                'designation' => '',
                'description' => '',
                'prix_unitaire' => ''
            ]
        ];
    }

    public function booted()
    {
        $this->orderProducts = $this->command->products()->get();
    }

    public function removeProduct($id)
    {
        //dd($id);
        $this->command->products()->wherePivot('id', $id)->detach();
        $this->mount();
    }


    /****Add Product */
    public function getPrice($index)
    {

        if ($this->newOrderProducts[$index]['product_id'] !== "") {
            $this->newOrderProducts[$index]['prix_unitaire'] =  $this->products->firstWhere('id', $this->newOrderProducts[$index]['product_id'])->price;
        }
    }


    public function removeItem($index)
    {
        unset($this->newOrderProducts[$index]);
        $this->newOrderProducts = array_values($this->newOrderProducts);
    }

    public function addNewProduct()
    {
        $this->newOrderProducts[] = [
            'product_id' => '',
            'quantity' => 1,
            'designation' => '',
            'description' => '',
            'prix_unitaire' => ''
        ];
    }
}
