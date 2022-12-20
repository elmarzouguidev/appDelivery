<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\DeliveryInvoice;

class InvoiceSubDeliveryController extends Controller
{
    public function index()
    {
        $this->deleteNullInvoices();

        return view('Sameleon.Admin.SubDelivery.Invoice.index');
    }

    private function deleteNullInvoices()
    {
        $invoices = DeliveryInvoice::doesntHave('articles')->get();

        if ($invoices) {
            foreach ($invoices as $invoice) {
                $invoice->delete();
            }
        }
    }
}
