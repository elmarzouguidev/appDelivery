<?php

namespace App\Http\Livewire\Sameleon\Command;

use App\Models\Sameleon\Product;
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
        if (auth()->user()->hasRole('Client')) {
            $this->products = auth()->user()->products()->get();
        } else {
            $this->products = Product::with('media')->get();
        }

        $this->orderProducts = $this->command->items()->get();

        $this->newOrderProducts = [
            [
                'product_id' => '',
                'quantity' => 1,
                'designation' => '',
                'description' => '',
                'prix_unitaire' => '',
            ],
        ];

        //dd('ffOnevvvvvvvvvvvvvvr');
    }

    public function booted()
    {
        //
        $this->orderProducts = $this->command->items()->get();
    }

    public function removeProduct($id)
    {
        $this->command->items()->where('uuid', $id)->delete();

        $this->mount();
    }

    /****Add Product */
    public function getPrice($index)
    {
        if ($this->newOrderProducts[$index]['product_id'] !== '') {
            $this->newOrderProducts[$index]['prix_unitaire'] = $this->products->firstWhere('id', $this->newOrderProducts[$index]['product_id'])->price;
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
            'prix_unitaire' => '',
        ];
    }
}
