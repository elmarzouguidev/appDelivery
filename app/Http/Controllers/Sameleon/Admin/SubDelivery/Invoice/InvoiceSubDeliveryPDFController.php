<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\DeliveryInvoice;
use Illuminate\Http\Request;

class InvoiceSubDeliveryPDFController extends Controller
{

    public function showInvoice(Request $request, DeliveryInvoice $invoice)
    {
        $request->validate(['has_header' => ['required', 'boolean']]);

        $hasHeader = $request->has_header;

        $invoice->load('articles','articles.command', 'delivery', 'delivery.commands');

        $companyLogo = "data:image/jpg;base64," . base64_encode(file_get_contents(public_path('storage/' . getCompany()->logo)));

        $pdf = \PDF::loadView('Sameleon.PDF.DELIVERY.invoice-delivery', compact('invoice', 'companyLogo', 'hasHeader'));

        $fileName = $invoice->invoice_date->format('d-m-Y') . "-[ {$invoice->delivery->full_name} ]-" . 'DELIVERY-FACTURE-' . "{$invoice->code}" . '.pdf';

        return $pdf->stream($fileName);
    }
}
