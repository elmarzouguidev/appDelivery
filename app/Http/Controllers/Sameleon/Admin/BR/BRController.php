<?php

namespace App\Http\Controllers\Sameleon\Admin\BR;

use App\Actions\Sameleon\BRouterAction;
use App\Http\Controllers\Controller;
use App\Models\Sameleon\BRouter;
use App\Repositories\BR\BRInterface;
use Illuminate\Http\Request;

class BRController extends Controller
{
    public function index()
    {
        BRouterAction::run();

        $bons = app(BRInterface::class)->getBRs();

        return view('Sameleon.Admin.BR.index', compact('bons'));
    }

    public function delete(Request $request)
    {
        $request->validate(['bonRId' => 'required|uuid']);

        $bon = BRouter::whereUuid($request->bonRId)->firstOrFail();

        $this->authorize('delete', $bon);

        if ($bon) {
            $bon->articles()->delete();

            $bon->delete();

            return redirect()->back()->with('success', 'le BON de retour a été supprimer avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }
}
