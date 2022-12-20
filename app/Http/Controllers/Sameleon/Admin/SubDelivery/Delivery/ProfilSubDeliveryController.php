<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Admin\UpdateProfilFormRequest;
use App\Http\Requests\Sameleon\Admin\UpdateProfilPasswordFormRequest;
use App\Models\Sameleon\Bank;
use App\Repositories\Bank\BankInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilSubDeliveryController extends Controller
{
    public function index()
    {
        $user = delivery();

        //$banks = app(BankInterface::class)->getBanks();

        //$bankAccount = $user->bank()->first();
        //dd($bank->account->rib);

        return view('Sameleon.Admin.SubDelivery.Setting.profil.index', compact('user'));
    }

    public function update(UpdateProfilFormRequest $request)
    {
        $user = delivery();

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
                $user->logo = $request->file('logo')->store('delivries', ['disk' => 'public']);
                Storage::disk('public')->delete($old);
            }

            $user->save();

            return back()->with('success', 'Profile Updated');
        }

        return back()->with('error', 'Profile Not Updated');
    }

    public function updatePassword(UpdateProfilPasswordFormRequest $request)
    {
        $user = delivery();

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
}
