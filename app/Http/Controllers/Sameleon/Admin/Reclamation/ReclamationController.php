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
        $reclamation->user_id = auth()->id();
        $reclamation->save();
    }
}
