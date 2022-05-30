<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Admin\UpdateBankFormRequest;
use App\Http\Requests\Sameleon\Admin\UpdateCompanyFormRequest;
use App\Http\Requests\Sameleon\Admin\UpdateProfilFormRequest;
use App\Http\Requests\Sameleon\Admin\UpdateProfilPasswordFormRequest;
use App\Models\Sameleon\Bank;
use App\Models\Sameleon\User;
use App\Repositories\Bank\BankInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilController extends Controller
{

    public function index()
    {

        $user = auth()->user();

        $user->load('documents');

        $banks = app(BankInterface::class)->getBanks();

        $bankAccount = $user->bank()->first();
        //dd($bank->account->rib);

        return view('Sameleon.Admin.Setting.profil.index', compact('user', 'banks', 'bankAccount'));
    }

    public function update(UpdateProfilFormRequest $request)
    {

        $user = auth()->user();

        if ($user->uuid == $request->userId) {

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

        if ($user->uuid == $request->hasPassword) {

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

    public function updateBank(UpdateBankFormRequest $request)
    {
        $user = auth()->user();

        $bankAccount = $user->bank()->first();

        if (!$bankAccount) {

            $user->banks()->attach(
                (int)$request->bank,
                [
                    'type' => 'client',
                    'rib' => $request->code_rib,
                    'user_uuid' => $user->uuid,
                    'bank_uuid' => Bank::find($request->bank)->uuid
                ],
            );
        } else {
            
            $user->banks()->updateExistingPivot((int)$request->bank, [
                'type' => 'client',
                'rib' => $request->code_rib,
                'user_uuid' => $user->uuid,
                'bank_uuid' => Bank::find($request->bank)->uuid
            ]);
        }

        return redirect()->back()->with('success', "Le compte a été ajouter");
    }
}
