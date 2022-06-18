<?php

namespace App\Http\Controllers\Sameleon\Admin\Annonce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Annonce\AnnonceFormRequest;
use App\Models\Sameleon\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index()
    {

        $annonces = Annonce::all();

        return view('Sameleon.Admin.Annonce.index', compact('annonces'));
    }

    public function store(AnnonceFormRequest $request)
    {
        $annonce = new Annonce();
        $annonce->title = $request->title;
        $annonce->description = $request->description;
        $annonce->save();

        return redirect(route('admin:annonces.index'))->with('success', "L'annonce a été ajouté avec succès");
    }

    public function activate(Request $request)
    {
        $request->validate(['annonceId' => 'required', 'uuid']);

        $annonce = Annonce::whereUuid($request->annonceId)->firstOrFail();

        if ($annonce) {

            $annonce->update(['active' => !$annonce->active]);

            $annonce->active ? $msg = "activé" : $msg = "desactivé";

            return redirect()->back()->with('success', "l'annonce a été $msg avec success");
        }

        return redirect()->back()->with('error', 'error !!!');
    }

    public function delete(Request $request)
    {

        $request->validate(['annonceId' => 'required|uuid']);

        $annonce = Annonce::whereUuid($request->annonceId)->firstOrFail();


        if ($annonce) {


            $annonce->delete();

            return redirect()->back()->with('success', "l'annonce a été supprimer avec success");
        }
        return redirect()->back()->with('error', 'Error ...');
    }
}
