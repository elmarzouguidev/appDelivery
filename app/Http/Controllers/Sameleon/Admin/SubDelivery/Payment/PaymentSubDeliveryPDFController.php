<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Payment;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentSubDeliveryPDFController extends Controller
{
    public function showBill(Request $request, Bill $bill)
    {
        $request->validate(['has_header' => ['required', 'boolean']]);

        $hasHeader = $request->has_header;

        $bill->load('billable:id,full_number,invoice_date', 'delivery');

        if (Storage::disk('public')->exists(getCompany()->logo)) {
            // dd('yes logo');
            $logo = public_path('storage/' . getCompany()->logo);
        } else {
            //dd('no its default logo');
            $logo = public_path('logo.png');
        }

        $companyLogo = 'data:image/jpg;base64,' . base64_encode(file_get_contents($logo));

        $pdf = \PDF::loadView('Sameleon.PDF.DELIVERY.bill-delivery', compact('bill', 'companyLogo', 'hasHeader'));

        $pdf->setPaper('a5');

        $fileName = $bill->bill_date?->format('d-m-Y') . "-[ {$bill->delivery?->full_name} ]-" . 'DELIVERY-REG-' . "{$bill->full_number}" . '.pdf';

        return $pdf->stream($fileName);
    }
}
