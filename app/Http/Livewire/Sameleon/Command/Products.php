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
                'prix_total' => 0,
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
        if (count($this->orderProducts) <= $this->products->count()) {
            $this->orderProducts[] = [
                'product_id' => '',
                'quantity' => 0,
                'designation' => '',
                'description' => '',
                'prix_unitaire' => '',
                'prix_total' => 0,
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

            //dd($prod,"##",$value);
            //dd($prod->isOutOfStock($value));
            if ($prod->isOutOfStock($value)) {
                $this->dispatchBrowserEvent('out-of-stock', ['product' => $prod->name]);
            }

            $this->orderProducts[$array[1]]['prix_unitaire'] = $prod->price;
            $this->orderProducts[$array[1]]['prix_total'] = $prod->price * (int)$value;

            /* dd($this->products);
            $this->products->filter(function ($value, $key) use ($array) {

                return $value->id == $this->orderProducts[$array[1]]['product_id'];
            });*/
            //unset($this->products[$array[1]]);

            /*$this->products = $this->products->reject(function ($item) use($array) {
               // dd($array,"###",$item->id ,(int)$this->orderProducts[$array[1]]['product_id']);
                return $item->id === (int)$this->orderProducts[$array[1]]['product_id'];
            });*/
        }
    }

    public function removeProduct($index)
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }
}
