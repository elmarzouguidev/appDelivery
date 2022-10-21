<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Command;

use App\Actions\Sameleon\InvoiceDeliveryGenerator;
use App\Http\Controllers\Controller;
use App\Repositories\City\CityInterface;
use App\Repositories\Command\CommandInterface;
use Illuminate\Http\Request;

class CommandSubDeliveryController extends Controller
{


    public function index()
    {
        $cities = app(CityInterface::class)->getCities();

        InvoiceDeliveryGenerator::run();

        return view('Sameleon.Admin.SubDelivery.Command.index', compact('cities'));
    }

    public function archived()
    {
        $commands = app(CommandInterface::class)->getArchivedCommands();

        return view('Sameleon.Admin.SubDelivery.Command.Archive.index', compact('commands'));
    }
}
