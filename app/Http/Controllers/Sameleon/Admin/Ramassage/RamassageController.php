<?php

namespace App\Http\Controllers\Sameleon\Admin\Ramassage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Ramassage\NewRamassageFormRequest;
use App\Http\Requests\Sameleon\Ramassage\RamassageFormRequest;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Ramassage;
use Illuminate\Http\Request;

class RamassageController extends Controller
{


    public function index()
    {

        if (isClient()) {

            $ramassages = Ramassage::where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->with('product:id,uuid')
                ->orderBy('accepted','desc')
                ->get();
        } else {
            $ramassages = Ramassage::whereActive(true)
                //->whereAccepted(false)
                ->with('client:id,nom,prenom')
                ->orderBy('accepted','asc')
             
                ->get();
        }

        return view('Sameleon.Admin.Ramassage.index', compact('ramassages'));
    }

    public function newStore(NewRamassageFormRequest $request)
    {
        $ramassage = new Ramassage();
        $ramassage->name = $request->name;
        $ramassage->price = $request->price;
        $ramassage->qte = $request->qte;
        $ramassage->addresse = $request->addresse;
        $ramassage->notes = $request->notes;
        $ramassage->user_id = auth()->id();
        $ramassage->user_uuid = auth()->user()->uuid;
        $ramassage->save();

        return redirect()->back()->with('success', "La demande a éte ajouter avec success");
    }

    /*****Old methed to be contunied */
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

        return redirect()->back()->with('success', "L'adresse de ramassage a éte envoyer avec success");
    }

    public function Activedemande(Request $request)
    {
        $request->validate(['ramassageId' => 'required', 'uuid']);

        $product = Ramassage::whereUuid($request->ramassageId)->first();

        if ($product) {
            $product->update(['active' => true]);
            return redirect()->back()->with('success', "Le demande  a éte envoyer avec success");
        }
        return redirect()->back()->with('error', "error !!!");
    }

    public function Acceptdemande(Request $request)
    {
        $request->validate(['ramassageId' => 'required', 'uuid']);

        $product = Ramassage::whereUuid($request->ramassageId)->first();

        if ($product) {
            $product->update(['accepted' => true]);
            return redirect()->back()->with('success', "Le demande a éte accepter avec success");
        }
        return redirect()->back()->with('error', "error !!!");
    }

    public function delete(Request $request)
    {
        $request->validate(['ramassageDeleteId' => 'required', 'uuid']);

        $product = Ramassage::whereUuid($request->ramassageDeleteId)->first();

        if ($product) {

            $product->delete();

            return redirect()->back()->with('success', "Le demande a éte supprimer avec success");
        }
        return redirect()->back()->with('error', "error !!!");
    }
}
