<?php

namespace App\Http\Controllers\Sameleon\Admin\Command;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Command;
use Illuminate\Http\Request;

class PrintController extends Controller
{



    public function index()
    {
    }

    public function getCommands($command)
    {

        //dd($commands, "Yes from PrintController");

        $command = Command::withSum('items', 'prix_total')->find($command)->first();


        $companyLogo = "data:image/jpg;base64," . base64_encode(file_get_contents(public_path('storage/company/' . getCompany()->logo)));

        $pdf = \PDF::loadView('Sameleon.PDF.print-command', compact('companyLogo', 'command'));

        $fileName = $command->created_at->format('d-m-Y') . 'CMD-' . "{$command->code}" . '.pdf';


        return $pdf->stream($fileName);
    }
}
