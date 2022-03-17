<?php

namespace App\Http\Controllers\Sameleon\Admin\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Register\RegisterFormRequest;
use App\Http\Requests\Sameleon\Register\RegisterUpdateFormRequest;
use App\Models\Sameleon\Client;
use App\Repositories\City\CityInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientController extends Controller
{


    public function index()
    {
        $clients = Client::all();

        return  view('Sameleon.Admin.Client.index', compact('clients'));
    }

    public function create()
    {

        $cities = app(CityInterface::class)->getCities();

        return  view('Sameleon.Admin.Client.__create.index', compact('cities'));
    }

    public function store(RegisterFormRequest $request)
    {

        $client = new Client();

        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->email = $request->email;
        $client->addresse = $request->addresse;
        $client->telephone = $request->telephone;

        $client->type = $request->type;
        $client->cnie = $request->cnie;

        $pass = Str::random(9);

        $client->password = $pass = Hash::make($pass);

        $client->city()->associate($request->city);

        $client->save();

        return redirect()->back()->with('success', 'le client a été ajouter avec success');
    }

    public function edit(Client $client)
    {
        $cities = app(CityInterface::class)->getCities();

        return view('Sameleon.Admin.Client.__edit.index', compact('client', 'cities'));
    }

    public function update(RegisterUpdateFormRequest $request, Client $client)
    {

        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->email = $request->email;
        $client->addresse = $request->addresse;
        $client->telephone = $request->telephone;

        $client->type = $request->type;
        $client->cnie = $request->cnie;

        //$pass = Str::random(9);

        // $client->password = $pass = Hash::make($pass);

        $client->city()->associate($request->city);

        $client->save();

        return redirect()->back()->with('success', 'le client a été modifier avec success');
    }

    public function delete(Request $request)
    {
        $request->validate(['clientId' => 'required|uuid']);

        $client = Client::whereUuid($request->clientId)->firstOrFail();

        if ($client) {

            // dd('Yes client');
            // $client->delete();

            return redirect()->back()->with('success', 'le client a été modifier avec success');
        }
        return redirect()->back()->with('error', 'Error ...');
    }
}
