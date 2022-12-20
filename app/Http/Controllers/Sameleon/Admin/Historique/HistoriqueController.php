<?php

namespace App\Http\Controllers\Sameleon\Admin\Historique;

use App\Http\Controllers\Controller;

class HistoriqueController extends Controller
{
    public function index()
    {
        return view('Sameleon.Admin.Historique.index');
    }
}
