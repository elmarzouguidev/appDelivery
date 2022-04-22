<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Admin\UpdateCompanyFormRequest;
use App\Http\Requests\Sameleon\Admin\UpdateProfilFormRequest;
use App\Http\Requests\Sameleon\Admin\UpdateProfilPasswordFormRequest;
use App\Models\Sameleon\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{

    public function index()
    {

        $user = auth()->user();
        $user->load('documents');

        return view('Sameleon.Admin.Setting.profil.index', compact('user'));
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

            if ($request->hasFile('logo')) {
                
                $old = $user->logo;
                $user->logo = $request->file('logo')->store('users', ['disk' => 'public']);
                Storage::disk('public')->delete($old);
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

    public function updateCompany(
        UpdateCompanyFormRequest $request,

    ) {

        $company = auth()->user()->company()->updateOrCreate(

            ['user_uuid' => auth()->user()->uuid],
            [
                'user_uuid' => auth()->user()->uuid,
                'name' => $request->name,
                'website' => $request->website,
                'logo' => $request->logo,
                'city' => $request->city,
                'addresse' => $request->addresse,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'rc' => $request->rc,
                'ice' => $request->ice,
                'cnss' => $request->cnss,
                'patente' => $request->patente,
                'if' => $request->if,
            ]
        );
        if ($company) {
            return redirect()->back()->with('success', "Update a éte effectuer avec success");
        }

        return redirect()->back()->with('error', "Error");
    }
}
