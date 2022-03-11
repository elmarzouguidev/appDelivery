<?php

namespace App\Http\Controllers\Sameleon\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Register\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    public function index()
    {
        return view('theme.Sameleon.Register.index');
    }

    public function store(RegisterFormRequest $request)
    {

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        $user->type = $request->type;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->active = false;
        $user->save();

        $user->assignRole('Client');

        return redirect()->back()->with('success', 'Votre compte a été crée  avec success ');
    }
}
