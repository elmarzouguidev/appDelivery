<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Delivery\DeliveryCreateFormRequest;
use App\Http\Requests\Sameleon\Delivery\DeliveryUpdateFormRequest;
use App\Models\Sameleon\Delivery;
use App\Notifications\Sameleon\SendNewDeliveryPassword;
use App\Repositories\City\CityInterface;
use App\Repositories\Delivery\DeliveryInterface;
use App\Services\Mail\CheckConnection;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SubDeliveryController extends Controller
{
    public function index()
    {

        $this->authorize('viewAny', Delivery::class);

        $deliveries = app(DeliveryInterface::class)->getDeliveries();

        return  view('Sameleon.Admin.SubDelivery.Delivery.__normal_table.index', compact('deliveries'));
    }

    public function create()
    {

        $this->authorize('create', Delivery::class);

        return  view('Sameleon.Admin.SubDelivery.Delivery.__create.index');
    }

    public function store(DeliveryCreateFormRequest $request)
    {

        $this->authorize('create', Delivery::class);

        $delivery = new Delivery();

        $delivery->nom = $request->nom;
        $delivery->prenom = $request->prenom;
        $delivery->email = $request->email;
        $delivery->addresse = $request->addresse;
        $delivery->telephone = $request->telephone;

        $delivery->type = "particulier";
        //$delivery->cnie = $request->cnie;

        $pass = $request->email;

        if ($request->boolean('generate_password')) {

            $pass = Str::random(9);
        }

        $delivery->password = Hash::make($pass);

        $delivery->parent_id = auth()->id();

        $delivery->parent_uuid = auth()->user()->uuid;

        $delivery->city()->associate(auth()->user()->city);

        $delivery->save();


        $delivery->assignRole('SubDelivery');


        if ($request->boolean('generate_password') && CheckConnection::isConnected()) {

            $delivery->notify(new SendNewDeliveryPassword($pass));
        }

        return redirect()->route('delivery:delivery.index')->with('success', 'le livreur a été ajouter avec success est le mot de pass a été envoyer');
    }

    public function edit(Delivery $delivery)
    {
        $this->authorize('update', $delivery);

        $cities = app(CityInterface::class)->getCities();

        //$delivery->load('regions');

        return view('Sameleon.Admin.SubDelivery.Delivery.__edit.index', compact('delivery', 'cities'));
    }

    public function update(DeliveryUpdateFormRequest $request, Delivery $delivery)
    {

        $this->authorize('update', $delivery);

        $delivery->nom = $request->nom;
        $delivery->prenom = $request->prenom;
        $delivery->email = $request->email;
        $delivery->addresse = $request->addresse;
        $delivery->telephone = $request->telephone;

        //$pass = Str::random(9);

        // $client->password = $pass = Hash::make($pass);

        $delivery->save();

        return redirect()->route('delivery:delivery.index')->with('success', 'le livreure a été modifier avec success');
    }

    public function delete(Request $request)
    {
        $request->validate(['deliveryId' => 'required|uuid']);

        $delivery = Delivery::whereUuid($request->deliveryId)
            ->whereParentId(delivery()->id)
            ->whereParentUuid(delivery()->uuid)
            ->firstOrFail();
        if ($delivery) {

            $delivery->delete();

            return redirect()->back()->with('success', 'le livreur a été supp avec success');
        }
        return redirect()->back()->with('error', 'error !! ');
    }
}
