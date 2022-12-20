<?php

namespace App\Http\Controllers\Sameleon\Admin\Bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Bank\BankFormRequest;
use App\Http\Requests\Sameleon\Bank\BankUpdateFormRequest;
use App\Models\Sameleon\Bank;
use App\Repositories\Bank\BankInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
    public function index()
    {
        $banks = app(BankInterface::class)->getBanks();

        return view('Sameleon.Admin.Bank.index', compact('banks'));
    }

    public function create()
    {
        return view('Sameleon.Admin.Bank.create.index');
    }

    public function store(BankFormRequest $request)
    {
        $bank = new Bank();
        $bank->name = $request->name;

        if ($request->hasFile('logo')) {
            $bank->logo = $request->file('logo')->store('banks', ['disk' => 'public']);
        }

        $bank->save();

        return redirect(route('admin:banks.index'))->with('success', 'la Banque a été ajouté avec succès');
    }

    public function edit(Bank $bank)
    {
        return view('Sameleon.Admin.Bank.edit.index', compact('bank'));
    }

    public function update(BankUpdateFormRequest $request, Bank $bank)
    {
        $bank->name = $request->name;

        if ($request->hasFile('logo')) {
            $old = $bank->logo;
            $bank->logo = $request->file('logo')->store('banks', ['disk' => 'public']);
            Storage::disk('public')->delete($old);
        }

        $bank->save();

        return redirect(route('admin:banks.index'))->with('success', 'la Banque a été modifier avec succès');
    }

    public function activate(Request $request)
    {
        $request->validate(['bankId' => 'required', 'uuid']);

        $bank = Bank::whereUuid($request->bankId)->firstOrFail();

        if ($bank) {
            $bank->update(['active' => ! $bank->active]);

            $bank->active ? $msg = 'activé' : $msg = 'desactivé';

            return redirect()->back()->with('success', "la banque a été $msg avec success");
        }

        return redirect()->back()->with('error', 'error !!!');
    }

    public function delete(Request $request)
    {
        $request->validate(['bankId' => 'required|uuid']);

        $bank = Bank::whereUuid($request->bankId)->firstOrFail();

        $this->authorize('delete', $bank);

        if ($bank) {
            Storage::disk('public')->delete($bank->logo);

            $bank->users()->detach();

            $bank->delete();

            return redirect()->back()->with('success', 'la banque a été supprimer avec success');
        }

        return redirect()->back()->with('error', 'Error ...');
    }
}
