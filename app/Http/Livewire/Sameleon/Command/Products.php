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

    public $products;

    public $totalPrice;

    public $orderProducts = [];

    public function mount()
    {

        $this->orderProducts = [
            [
                'product_id' => '',
                'quantity' => 0,
                'designation' => '',
                'description' => '',
                'prix_unitaire' => '',
                'prix_total' => '',
                'readonly' => ''
            ]
        ];
        $this->totalPrice = 0;

        if (auth()->user()->hasRole('Client')) {

            $this->products = auth()->user()->products()->get();
        } else {
            $this->products = Product::all();
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

        if (count($this->orderProducts) < $this->products->count()) {
            $this->orderProducts[] = [
                'product_id' => '',
                'quantity' => 0,
                'designation' => '',
                'description' => '',
                'prix_unitaire' => '',
                'prix_total' => '',
                'readonly' => ''
            ];
        }
    }

    public function updated($property, $value)
    {

        $key =  substr($property, strrpos($property, '.') + 1);
        $array =  explode('.', $property);
        //dd($array,"##",$key);

        if ($key === 'quantity' && !is_null($value) && is_numeric($value)) {

            //dd('Oui okey',"##",$value,"###",$key);
            $prod = $this->products->firstWhere('id', $this->orderProducts[$array[1]]['product_id']);

            if ($prod->isOutOfStock((int)$value)) {
                $this->dispatchBrowserEvent('out-of-stock', ['product' => $prod->name]);
            }

            $this->orderProducts[$array[1]]['prix_unitaire'] = $prod->price;
            $this->orderProducts[$array[1]]['prix_total'] = $prod->price * (int)$value;

            /* dd($this->products);
            $this->products->filter(function ($value, $key) use ($array) {

                return $value->id == $this->orderProducts[$array[1]]['product_id'];
            });*/
            //unset($this->products[$array[1]]);
        }
    }

    public function removeProduct($index)
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }
}
