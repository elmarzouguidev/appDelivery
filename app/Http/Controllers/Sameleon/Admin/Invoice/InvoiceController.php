<?php

namespace App\Http\Controllers\Sameleon\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
   

    public function showInvoice(Request $request, Invoice $invoice)
    {
        $request->validate(['has_header' => ['required', 'boolean']]);

        $hasHeader = $request->has_header;

        $invoice->load('articles','client','client.commands');

        $companyLogo = "data:image/jpg;base64," . base64_encode(file_get_contents(public_path('storage/' . $invoice->company->logo)));

        $pdf = \PDF::loadView('Sameleon.PDF.invoice', compact('invoice', 'companyLogo', 'hasHeader'));

        $fileName = $invoice->invoice_date->format('d-m-Y') . "-[ {$invoice->client->full_name} ]-" . 'FACTURE-' . "{$invoice->code}" . '.pdf';

        return $pdf->stream($fileName);
    }
}
