<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Delivery;
use App\Repositories\Delivery\DeliveryInterface;
use Illuminate\Http\Request;

class SubDeliveryController extends Controller
{
    public function index()
    {

        $this->authorize('viewAny', Delivery::class);

        $deliveries = app(DeliveryInterface::class)->getDeliveries();

        return  view('Sameleon.Admin.Delivery.__normal_table.index', compact('deliveries'));
    }

    public function create()
    {

        $this->authorize('create', Delivery::class);

        $cities = app(CityInterface::class)->getCities();

        return  view('Sameleon.Admin.Delivery.__create.index', compact('cities'));
    }

    public function store(DeliveryCreateFormRequest $request)
    {

        $this->authorize('create', User::class);

        $delivery = new Delivery();

        $delivery->nom = $request->nom;
        $delivery->prenom = $request->prenom;
        $delivery->email = $request->email;
        $delivery->addresse = $request->addresse;
        $delivery->telephone = $request->telephone;

        $delivery->type = $request->type;
        $delivery->cnie = $request->cnie;

        $pass = $request->email;

        if ($request->boolean('generate_password')) {

            $pass = Str::random(9);
        }

        $delivery->password = Hash::make($pass);

        $delivery->city()->associate($request->city);

        $delivery->save();

        if ($request->type == 'entreprise') {

            $delivery->assignRole('DeliveryEntreprise');
        } else {

            $delivery->assignRole('Delivery');
        }

        if ($request->type == 'entreprise' && $request->has('regions') && $request->filled('regions')) {

            Region::find($request->regions)->each->update(['delivery_id' => $delivery->id, 'delivery_uuid' => $delivery->uuid]);
        }

        if ($request->boolean('generate_password') && CheckConnection::isConnected()) {

            $delivery->notify(new SendNewDeliveryPassword($pass));
        }

        return redirect()->back()->with('success', 'le livreur a été ajouter avec success est le mot de pass a été envoyer');
    }

    public function edit(Delivery $delivery)
    {
        $this->authorize('update', $delivery);

        $cities = app(CityInterface::class)->getCities();

        $delivery->load('regions');

        return view('Sameleon.Admin.Delivery.__edit.index', compact('delivery', 'cities'));
    }

    public function update(DeliveryUpdateFormRequest $request, Delivery $delivery)
    {

        $this->authorize('update', $delivery);

        $delivery->nom = $request->nom;
        $delivery->prenom = $request->prenom;
        $delivery->email = $request->email;
        $delivery->addresse = $request->addresse;
        $delivery->telephone = $request->telephone;

        $delivery->type = $request->type;
        $delivery->cnie = $request->cnie;

        //$pass = Str::random(9);

        // $client->password = $pass = Hash::make($pass);

        $delivery->city()->associate($request->city);

        $delivery->save();

        return redirect()->route('admin:delivery.index')->with('success', 'le livreure a été modifier avec success');
    }

    public function delete(Request $request)
    {
        $request->validate(['deliveryId' => 'required|uuid']);

        $delivery = Delivery::whereUuid($request->deliveryId)->firstOrFail();
        if ($delivery) {
            $delivery->commandsDelivery->each->update(['delivery_id' => null, 'delivery_uuid' => null]);
            $delivery->delete();
            return redirect()->back()->with('success', 'le livreure a été supp avec success');
        }
        return redirect()->back()->with('error', 'error !! ');
    }
}
