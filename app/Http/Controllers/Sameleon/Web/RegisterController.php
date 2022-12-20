<?php

namespace App\Http\Controllers\Sameleon\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Register\FirstRegisterRequest;
use App\Models\Sameleon\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Sameleon.Register.index2');
    }

    public function store(FirstRegisterRequest $request)
    {
        $permissions = Permission::all()->pluck('name');

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        $user->type = $request->type;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->active = false;
        $user->is_client = true;
        $user->save();

        $user->assignRole('Client');

        $user->syncPermissions($permissions);

        //return redirect()->back()->with('success', 'Votre compte a été crée  avec success ');

        return redirect(route('admin:auth:login'))->with('success', 'Votre compte a été crée  avec success ');
    }
}
