<?php

namespace App\Http\Controllers\Sameleon\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    

    public function index()
    {
        return view('Sameleon.Admin.Home.index');
    }
}
