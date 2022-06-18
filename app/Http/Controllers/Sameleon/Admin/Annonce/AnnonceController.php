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
    }
}
