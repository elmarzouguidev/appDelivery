<?php

namespace App\Http\Controllers\Sameleon\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
   public function index()
   {
       return view('Sameleon.Client.Home.index');
   }
}
