<?php

namespace App\Http\Controllers\Sameleon\Admin\BR;

use App\Http\Controllers\Controller;
use App\Repositories\BR\BRInterface;
use Illuminate\Http\Request;

class BRController extends Controller
{

    public function index()
    {
        
        $bons = app(BRInterface::class)->getBRs();

        return view('Sameleon.Admin.BR.index', compact('bons'));
    }
}
