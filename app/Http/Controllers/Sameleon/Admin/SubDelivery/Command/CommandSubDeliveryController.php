<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Command;

use App\Http\Controllers\Controller;
use App\Repositories\City\CityInterface;
use Illuminate\Http\Request;

class CommandSubDeliveryController extends Controller
{


    public function index()
    {
        $cities = app(CityInterface::class)->getCities();

        return view('Sameleon.Admin.SubDelivery.Command.index', compact('cities'));
    }
}
