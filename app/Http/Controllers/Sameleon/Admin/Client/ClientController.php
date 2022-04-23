<?php

namespace App\Http\Controllers\Sameleon\Admin\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Register\RegisterFormRequest;
use App\Http\Requests\Sameleon\Register\RegisterUpdateFormRequest;
use App\Mail\Sameleon\Client\SendPasswordMail;
use App\Models\Sameleon\User;
use App\Notifications\Sameleon\SendNewUserPassword;
use App\Repositories\City\CityInterface;
use App\Services\Mail\CheckConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ClientController extends Controller
{

    public function index()
    {

        $this->authorize('viewAny', User::class);

        $clients = User::role('Client')->get();

        return  view('Sameleon.Admin.Client.index', compact('clients'));
    }

    public function create()
    {

        $this->authorize('create', User::class);

        $cities = app(CityInterface::class)->getCities();

        return  view('Sameleon.Admin.Client.__create.index', compact('cities'));
    }

    public function store(RegisterFormRequest $request)
    {

        $this->authorize('create', User::class);

        $client = new User();

        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->email = $request->email;
        $client->addresse = $request->addresse;
        $client->telephone = $request->telephone;

        $client->type = $request->type;
        $client->cnie = $request->cnie;

        $pass = Str::random(9);

        $client->password = Hash::make($pass);

        $client->city()->associate($request->city);

        $client->save();

        $client->assignRole('Client');

        if (CheckConnection::isConnected()) {

            $client->notify(new SendNewUserPassword($pass));

            return redirect()->back()->with('success', 'le client a été ajouter avec success');
        }
        return redirect()->back()->with('error', 'Email not send');
    }

    public function edit(User $client)
    {
        $this->authorize('update', $client);

        $cities = app(CityInterface::class)->getCities();

        return view('Sameleon.Admin.Client.__edit.index', compact('client', 'cities'));
    }

    public function update(RegisterUpdateFormRequest $request, User $client)
    {
        $this->authorize('update', $client);

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

        $client = User::whereUuid($request->clientId)->firstOrFail();

        $this->authorize('delete', $client);

        if ($client) {

            // dd('Yes client');
            $client->commands()->delete();
            $client->commands()->products()->delete();
            $client->products()->delete();
            $client->stocks()->delete();
            $client->company()->delete();
            $client->histories()->delete();
            $client->delete();

            return redirect()->back()->with('success', 'le client a été supprimer avec success');
        }
        return redirect()->back()->with('error', 'Error ...');
    }

    public function sendEstimate(User $user, string $password)
    {
        if (CheckConnection::isConnected()) {

            Mail::to($user)->send(new SendPasswordMail($password));

            if (empty(Mail::failures())) {

                return redirect()->back()->with('success', "l'email a été envoyé avec succès");
            }
        }
        return redirect()->back()->with('error', 'Email not send');
    }
}
