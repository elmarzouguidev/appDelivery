<?php

namespace App\Http\Controllers\Sameleon\Admin\Reclamation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Reclamation\ReclamationFormRequest;
use App\Models\Sameleon\Reclamation;
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    public function index()
    {
        return view('Sameleon.Admin.Reclamation.index');
    }

    public function store(ReclamationFormRequest $request)
    {

        $reclamation = new Reclamation();
        $reclamation->command_id = $request->command;
        $reclamation->message = $request->message;
        $reclamation->user_id = auth()->id();
        $reclamation->user_uuid = auth()->user()->uuid;

        $reclamation->save();

        return redirect()->back()->with('success', "La réclamation  a éte crée avec success");
    }

    public function delete(Request $request)
    {
        $request->validate(['complaintId' => 'required|uuid']);

        $rec = Reclamation::whereUuid($request->complaintId)->first();

        if ($rec) {

            // dd("oui i find it");
            $rec->delete();

            return redirect()->back()->with('success', "La réclamation  a éte supprimer avec success");
        }

        return redirect()->back()->with('error', "error !!");
    }
}
