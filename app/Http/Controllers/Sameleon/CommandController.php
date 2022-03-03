<?php

namespace App\Http\Controllers\Sameleon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    

    public function index()
    {
        return view('theme.Sameleon.Command.index');
    }
}
