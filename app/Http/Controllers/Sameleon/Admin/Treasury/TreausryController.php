<?php

namespace App\Http\Controllers\Sameleon\Admin\Treasury;

use App\Http\Controllers\Controller;

class TreausryController extends Controller
{
    public function index()
    {
        return view('Sameleon.Admin.Treausry.index');
    }
}
