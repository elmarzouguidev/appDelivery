<?php

namespace App\Http\Controllers\Sameleon\Admin\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Delivery\DeliveryCreateFormRequest;
use App\Http\Requests\Sameleon\Delivery\DeliveryUpdateFormRequest;
use App\Models\Sameleon\Region;
use App\Models\Sameleon\User;
use App\Notifications\Sameleon\SendNewUserPassword;
use App\Repositories\City\CityInterface;
use App\Services\Mail\CheckConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    public function index()
    {

        $this->authorize('viewAny', User::class);

        $deliveries = User::role('Delivery')->get();

        return  view('Sameleon.Admin.Delivery.index', compact('deliveries'));
    }

    public function create()
    {

        $this->authorize('create', User::class);

        $cities = app(CityInterface::class)->getCities();

        return  view('Sameleon.Admin.Delivery.__create.index', compact('cities'));
    }

    public function store(DeliveryCreateFormRequest $request)
    {

        //dd($request->all());

        $this->authorize('create', User::class);

        $delivery = new User();

        $delivery->nom = $request->nom;
        $delivery->prenom = $request->prenom;
        $delivery->email = $request->email;
        $delivery->addresse = $request->addresse;
        $delivery->telephone = $request->telephone;

        $delivery->type = $request->type;
        $delivery->cnie = $request->cnie;

        $pass = Str::random(9);

        $delivery->password = Hash::make($pass);

        $delivery->city()->associate($request->city);

        $delivery->save();

        $delivery->assignRole('Delivery');

        if ($request->has('regions') && $request->filled('regions')) {

            Region::find($request->regions)->each->update(['delivery_id' => $delivery->id, 'delivery_uuid' => $delivery->uuid]);
        }

        if (app()->environment('production') && CheckConnection::isConnected()) {

            $delivery->notify(new SendNewUserPassword($pass));

            return redirect()->back()->with('success', 'le livreure a été ajouter avec success est le mot de pass a été envoyer');
        }
        return redirect()->back()->with('error', 'le livreure a été ajouter avec success');
    }

    public function edit(User $delivery)
    {
        $this->authorize('update', $delivery);

        $cities = app(CityInterface::class)->getCities();

        $delivery->load('regions');
        
        return view('Sameleon.Admin.Delivery.__edit.index', compact('delivery', 'cities'));
    }

    public function update(DeliveryUpdateFormRequest $request, User $delivery)
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

        return redirect()->back()->with('success', 'le livreure a été modifier avec success');
    }
}
