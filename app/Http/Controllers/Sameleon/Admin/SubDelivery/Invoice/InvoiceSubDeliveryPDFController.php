<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\DeliveryInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceSubDeliveryPDFController extends Controller
{
    public function showInvoice(Request $request, DeliveryInvoice $invoice)
    {
        $request->validate(['has_header' => ['required', 'boolean']]);

        $hasHeader = $request->has_header;

        $invoice->load('articles', 'articles.command', 'delivery', 'delivery.commands');

        if (Storage::disk('public')->exists(getCompany()->logo)) {
            // dd('yes logo');
            $logo = public_path('storage/' . getCompany()->logo);
        } else {
            //dd('no its default logo');
            $logo = public_path('logo.png');
        }

        $companyLogo = 'data:image/jpg;base64,' . base64_encode(file_get_contents($logo));

        $pdf = \PDF::loadView('Sameleon.PDF.DELIVERY.invoice-delivery', compact('invoice', 'companyLogo', 'hasHeader'));

        $fileName = $invoice->invoice_date?->format('d-m-Y') . "-[ {$invoice->delivery?->full_name} ]-" . 'DELIVERY-FACTURE-' . "{$invoice->code}" . '.pdf';

        return $pdf->stream($fileName);
    }
}
