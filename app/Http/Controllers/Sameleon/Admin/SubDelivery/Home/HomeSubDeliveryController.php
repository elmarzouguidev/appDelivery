<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeSubDeliveryController extends Controller
{


    public function index()
    {
        return view('Sameleon.Admin.SubDelivery.Home.index');
    }
}
