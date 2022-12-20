<?php

namespace App\Http\Controllers\Sameleon\Admin\Reclamation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Reclamation\ReclamationFormRequest;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Reclamation;
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Client')) {
            $commands = Command::where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->select(['id', 'code'])->get();
            $complaints = Reclamation::where('user_id', auth()->id())
                ->with('command')
                ->whereActive(true)
                ->get();
            $count = $complaints->count();
        } else {
            $commands = Command::select(['id', 'code'])->get();
            $complaints = Reclamation::with('user', 'command')
                ->whereActive(true)
                ->get();
            $count = $complaints->count();
        }

        return view('Sameleon.Admin.Reclamation.index', compact('complaints', 'commands', 'count'));
    }

    public function store(ReclamationFormRequest $request)
    {
        $reclamation = new Reclamation();
        $reclamation->command_id = $request->command;

        $reclamation->message = $request->message;

        //$reclamation->priority = $request->priority;

        $reclamation->user_id = auth()->id();

        $reclamation->user_uuid = auth()->user()->uuid;

        $reclamation->save();

        return redirect()->back()->with('success', 'La réclamation  a éte crée avec success');
    }

    public function show(Reclamation $reclamation)
    {
        return view('Sameleon.Admin.ReclamationV2.show.index', compact('reclamation'));
    }

    public function delete(Request $request)
    {
        $request->validate(['complaintId' => 'required|uuid']);

        $rec = Reclamation::whereUuid($request->complaintId)->first();

        if ($rec) {
            // dd("oui i find it");
            $rec->delete();

            return redirect()->back()->with('success', 'La réclamation  a éte supprimer avec success');
        }

        return redirect()->back()->with('error', 'error !!');
    }
}
