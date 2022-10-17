<?php

namespace App\Http\Controllers\Sameleon\Admin\BR;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\BRouter;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class PDFBRController extends Controller
{
    public function showBL(Request $request, BRouter $bon)
    {

        //$qrcode = Qrcode::encoding("UTF-8")->size(200)->generate("https://sameleon-express.ma/");
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate('https://sameleon-express.ma/'));

        $bon->load('articles', 'city:id,name','articles.command.items');

        $companyLogo = "data:image/jpg;base64," . base64_encode(file_get_contents(public_path('storage/company/' . getCompany()->logo)));

        $pdf = \PDF::loadView('Sameleon.PDF.bl', compact('bon', 'companyLogo','qrcode'));

        $fileName = $bon->bon_date->format('d-m-Y') . 'BROUTER-' . "{$bon->full_number}" . '.pdf';

    
        return $pdf->stream($fileName);
    }
}
