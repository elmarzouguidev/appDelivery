<?php

namespace App\Http\Controllers\Sameleon\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\User;
use App\Status\Status;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    

    public function index()
    {
        $deliviers = User::role('Delivery')
        ->withCount('commandsDelivery')

        ->get();

        return view('Sameleon.Admin.Home.index',compact('deliviers'));
    }
}
