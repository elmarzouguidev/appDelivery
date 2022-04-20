<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Admin\UpdateProfilFormRequest;
use App\Http\Requests\Sameleon\Admin\UpdateProfilPasswordFormRequest;
use App\Models\Sameleon\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{

    public function index()
    {

        $user = auth()->user();

        return view('Sameleon.Admin.Setting.Profil.index', compact('user'));
    }

    public function update(UpdateProfilFormRequest $request)
    {

        $user = auth()->user();

        if ($user->uuid === $request->userId) {

            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->telephone = $request->telephone;
            $user->addresse = $request->addresse;
            if (
                $request->has(['cnie']) &&
                $request->filled(['cnie'])
            ) {

                $user->cnie = $request->cnie;
            }
            $user->save();

            return back()->with('success', 'Profile Updated');
        }

        return back()->with('error', 'Profile Not Updated');
    }

    public function updatePassword(UpdateProfilPasswordFormRequest $request)
    {
        $user = auth()->user();

        if ($user->uuid === $request->hasPassword) {

            if (
                $request->has(['oldpassword', 'new_password', 'new_confirm_password']) &&
                $request->filled(['oldpassword', 'new_password', 'new_confirm_password'])
            ) {

                $user->password = Hash::make($request->new_password);
            }
            $user->save();

            return back()->with('success', 'Le mot de pass a été changé ');
        }

        return back()->with('error', 'Profile Not Updated');
    }
}
