<?php

namespace App\Http\Controllers\Sameleon\Admin\BL;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\BLivraison;
use App\Repositories\BL\BLInterface;
use Illuminate\Http\Request;

class BLController extends Controller
{
    //

    public function index()
    {
        
        $bons = app(BLInterface::class)->getBLs();


        return view('Sameleon.Admin.BL.index', compact('bons'));
    }

    public function delete(Request $request)
    {
        $request->validate(['bonLId' => 'required|uuid']);

        $bon = BLivraison::whereUuid($request->bonLId)->firstOrFail();

        $this->authorize('delete', $bon);

        if ($bon) {

            $bon->articles()->delete();
            
            $bon->delete();

            return redirect()->back()->with('success', 'le BON a été supprimer avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }
}
