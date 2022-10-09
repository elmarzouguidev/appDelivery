<?php

namespace App\Http\Controllers\Sameleon\Admin\BL;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\BLivraison;
use Illuminate\Http\Request;

class PDFBLController extends Controller
{
    public function showBL(Request $request, BLivraison $bon)
    {

        $bon->load('articles', 'city:id,name','articles.command.items');

        $companyLogo = "data:image/jpg;base64," . base64_encode(file_get_contents(public_path('storage/company/' . getCompany()->logo)));

        $pdf = \PDF::loadView('Sameleon.PDF.bl', compact('bon', 'companyLogo'));

        $fileName = $bon->bon_date->format('d-m-Y') . 'BL-' . "{$bon->full_number}" . '.pdf';

        return $pdf->stream($fileName);
    }
}
