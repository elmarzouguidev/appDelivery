<?php

namespace App\Http\Controllers\Sameleon\Admin\Ramassage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Ramassage\NewRamassageFormRequest;
use App\Http\Requests\Sameleon\Ramassage\RamassageFormRequest;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Ramassage;
use App\Notifications\RamassageAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class RamassageController extends Controller
{
    public function index()
    {
        $products = [];

        if (isClient()) {
            $products = Product::whereUserId(client()->id)->whereUserUuid(client()->uuid)->get();
            $ramassages = Ramassage::where('user_id', client()->id)
                ->where('user_uuid', client()->uuid)
                ->with('product:id,uuid')
                ->orderBy('accepted', 'desc')
                ->get();
        } else {
            $ramassages = Ramassage::whereActive(true)
                //->whereAccepted(false)
                ->with('client:id,nom,prenom')
                ->orderBy('accepted', 'asc')
                ->get();
        }

        return view('Sameleon.Admin.Ramassage.index', compact('ramassages', 'products'));
    }

    public function newStore(NewRamassageFormRequest $request)
    {
        $ramassage = new Ramassage();
        $ramassage->qte = $request->qte;
        $ramassage->addresse = $request->addresse;
        $ramassage->notes = $request->notes;
        $ramassage->user_id = client()->id;
        $ramassage->user_uuid = client()->uuid;

        if ($request->has('product') && $request->filled('product')) {
            $product = Product::whereUserId(client()->id)
                ->whereUserUuid(client()->uuid)
                ->whereId($request->product)
                ->first();
            $ramassage->name = $product->name;
            $ramassage->price = $product->price;
            $ramassage->product()->associate($product);
            $ramassage->product_uuid = $product->uuid;
        } else {
            $ramassage->name = $request->name;
            $ramassage->price = $request->price;
        }
        $ramassage->save();

        return redirect()->back()->with('success', 'La demande a éte ajouter avec success');
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
                'active' => true,
            ]);
        }

        return redirect()->back()->with('success', "L'adresse de ramassage a éte envoyer avec success");
    }

    public function Activedemande(Request $request)
    {
        $request->validate(['ramassageId' => 'required', 'uuid']);

        $ramassage = Ramassage::whereUuid($request->ramassageId)->first();

        if ($ramassage) {
            $ramassage->update(['active' => true]);

            return redirect()->back()->with('success', 'Le demande  a éte envoyer avec success');
        }

        return redirect()->back()->with('error', 'error !!!');
    }

    public function Acceptdemande(Request $request)
    {
        $request->validate(['ramassageId' => 'required', 'uuid']);

        $ramassage = Ramassage::whereUuid($request->ramassageId)->first();

        if ($ramassage) {
            $ramassage->update(['accepted' => true]);

            $client = $ramassage->client()->first();

            Notification::send($client, new RamassageAccepted($ramassage));

            return redirect()->back()->with('success', 'Le demande a éte accepter avec success');
        }

        return redirect()->back()->with('error', 'error !!!');
    }

    public function delete(Request $request)
    {
        $request->validate(['ramassageDeleteId' => 'required', 'uuid']);

        $ramassage = Ramassage::whereUuid($request->ramassageDeleteId)->first();

        if ($ramassage) {
            client()->unreadNotifications->each(function ($notification) use ($ramassage) {
                $notification->data['uuid'] == $ramassage->uuid ? $notification->delete() : null;
            });

            $ramassage->delete();

            return redirect()->back()->with('success', 'Le demande a éte supprimer avec success');
        }

        return redirect()->back()->with('error', 'error !!!');
    }
}
