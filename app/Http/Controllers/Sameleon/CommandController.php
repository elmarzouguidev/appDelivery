<?php

namespace App\Http\Controllers\Sameleon;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Command;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    

    public function index()
    {
        $orders = Command::all();
        
        return view('theme.Sameleon.Command.index',compact('orders'));
    }
}
