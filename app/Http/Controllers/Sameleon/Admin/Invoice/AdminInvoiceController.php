<?php

namespace App\Http\Controllers\Sameleon\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Invoice;
use Illuminate\Http\Request;

class AdminInvoiceController extends Controller
{
    //

    public function index()
    {

        if (auth()->user()->hasRole('Client')) {
            $invoices = Invoice::authClient()->get();
        } else {
            $invoices = Invoice::withCount('commands')
                ->withSum('articles', 'price_total')
                ->get();
            //dd($invoices);   
        }

        return view('Sameleon.Admin.Invoice.__datatable.index', compact('invoices'));
    }
}
