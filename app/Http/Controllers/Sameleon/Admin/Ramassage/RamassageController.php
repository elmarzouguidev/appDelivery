<?php

namespace App\Http\Controllers\Sameleon\Admin\Ramassage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Ramassage\RamassageFormRequest;
use App\Models\Sameleon\Product;
use Illuminate\Http\Request;

class RamassageController extends Controller
{


    public function index()
    {

        if (auth()->user()->hasRole('Client')) {

            $products = Product::where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                //->where('qte_rest', 0)
                ->whereOutOfStock()
                ->where('can_ramassage', true)
                ->with('media')
                ->get();
        } else {
            $products = Product::with('client:id,nom,prenom','ramassage')
                ->whereOutOfStock()
                //->where('can_ramassage', false)
                ->with('media')
                ->get();
        }

        return view('Sameleon.Admin.Ramassage.index', compact('products'));
    }

    public function store(RamassageFormRequest $request)
    {

        $productsIds = json_decode($request->products, true);

        $products = Product::findMany($productsIds);

        //dd($products, json_decode($request->products, true));

        foreach ($products as $product) {

            $product->ramassage()->create([
                'addresse' => $request->address,
                'product_id' => $product->id,
                'product_uuid' => $product->uuid,
                'client_id' => auth()->id(),
                'client_uuid' => auth()->user()->uuid,
                'active' => true
            ]);
        }

        return redirect()->back()->with('success', "Le ramassage  a éte crée avec success");
    }

    public function demande(Request $request)
    {
        $request->validate(['productId' => 'required', 'uuid']);

        $product = Product::whereUuid($request->productId)->first();

        if ($product) {
            $product->update(['can_ramassage' => true]);
            return redirect()->back()->with('success', "Le demande  a éte envoyer avec success");
        }
        return redirect()->back()->with('error', "error !!!");
    }
}
