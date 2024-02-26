<?php

namespace App\Http\Controllers\Sameleon\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function showInvoice(Request $request, Invoice $invoice)
    {
        $request->validate(['has_header' => ['required', 'boolean']]);

        $hasHeader = $request->has_header;

        $invoice->load('articles', 'articles.command', 'client', 'client.commands', 'client.company');

        if (Storage::disk('public')->exists(getCompany()->logo)) {
            // dd('yes logo');
            $logo = public_path('storage/' . getCompany()->logo);
        } else {
            //dd('no its default logo');
            $logo = public_path('logo.png');
        }

        $companyLogo = 'data:image/jpg;base64,' . base64_encode(file_get_contents($logo));

        $pdf = \PDF::loadView('Sameleon.PDF.invoice', compact('invoice', 'companyLogo', 'hasHeader'));

        $fileName = $invoice->invoice_date->format('d-m-Y') . "-[ {$invoice->client->full_name} ]-" . 'FACTURE-' . "{$invoice->code}" . '.pdf';

        return $pdf->stream($fileName);
    }
}
