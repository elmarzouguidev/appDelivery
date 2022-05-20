<?php

namespace App\Http\Controllers\Sameleon\Admin\Ramassage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RamassageController extends Controller
{


    public function index()
    {
        return view('Sameleon.Admin.Ramassage.index');
    }
}
