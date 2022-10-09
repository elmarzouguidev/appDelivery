<?php

namespace App\Http\Controllers\Sameleon\Admin\BL;

use App\Http\Controllers\Controller;
use App\Repositories\BL\BLInterface;
use Illuminate\Http\Request;

class BLController extends Controller
{
    //

    public function index()
    {
        
        $bons = app(BLInterface::class)->getBLs();


        return view('Sameleon.Admin.BL.index', compact('bons'));
    }
}
