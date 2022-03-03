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

        $products = auth()->user()->products()->get();
        
        return view('theme.Sameleon.Command.index',compact('orders','products'));
    }

    public function create()
    {
        $products = auth()->user()->products()->get();
        return view('theme.Sameleon.Command.__create.index',compact('products'));
    }
}
