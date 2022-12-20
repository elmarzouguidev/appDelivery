<?php

namespace App\Http\Controllers\Sameleon\Admin\BR;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\BRouter;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFBRController extends Controller
{
    public function showBR(Request $request, BRouter $bon)
    {
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate('https://sameleon-express.ma/'));

        $bon->load('articles', 'client', 'articles.command.items', 'client.city', 'client.company');

        $companyLogo = 'data:image/jpg;base64,'.base64_encode(file_get_contents(public_path('storage/'.getCompany()->logo)));

        $pdf = \PDF::loadView('Sameleon.PDF.br', compact('bon', 'companyLogo', 'qrcode'));

        $fileName = $bon->bon_date->format('d-m-Y').'B-ROUTER-'."{$bon->full_number}".'.pdf';

        return $pdf->stream($fileName);
    }
}
