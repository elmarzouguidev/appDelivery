<?php

namespace App\Http\Controllers\Sameleon\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Bill;
use Illuminate\Http\Request;

class PDFPaymentController extends Controller
{

    public function showBill(Request $request, Bill $bill)
    {
  
        $request->validate(['has_header' => ['required', 'boolean']]);

        $hasHeader = $request->has_header;

        $bill->load('billable:id,full_number,invoice_date', 'client');

        $companyLogo = "data:image/jpg;base64," . base64_encode(file_get_contents(public_path('storage/' . getCompany()->logo)));

        $pdf = \PDF::loadView('Sameleon.PDF.bill', compact('bill', 'companyLogo', 'hasHeader'));

        $pdf->setPaper('a5');
        
        $fileName = $bill->bill_date->format('d-m-Y') . "-[ {$bill->client->full_name} ]-" . 'REG-' . "{$bill->full_number}" . '.pdf';

        return $pdf->stream($fileName);
    }
}
