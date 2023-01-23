<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\BL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Sameleon\BLivraison;
class SubDeliveryBLPDFController extends Controller
{
    public function showInvoice(Request $request, BLivraison $bon)
    {
        $route = route('public.public.show.bl', $bon->uuid);

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($route));

        $bon->load('articles', 'city:id,name', 'articles.command.items', 'delivery');

        $companyLogo = 'data:image/jpg;base64,'.base64_encode(file_get_contents(public_path('storage/'.getCompany()->logo)));

        $pdf = \PDF::loadView('Sameleon.PDF.bl', compact('bon', 'companyLogo', 'qrcode'));
        $pdf = \PDF::loadView('Sameleon.PDF.DELIVERY.invoice-delivery', compact('invoice', 'companyLogo', 'hasHeader'));

        $fileName = $bon->bon_date->format('d-m-Y').'BL-'."{$bon->full_number}".'.pdf';

        return $pdf->stream($fileName);
    }
}
