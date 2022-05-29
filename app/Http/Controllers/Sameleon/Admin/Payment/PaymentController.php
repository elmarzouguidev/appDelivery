<?php

namespace App\Http\Controllers\Sameleon\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Bill;
use App\Models\Sameleon\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Client')) {
            
            $payments = Bill::with('media', 'billable')
                ->where('client_id', auth()->id())
                ->where('client_uuid', auth()->user()->uuid)
                ->get();
        } else {
            $payments = Bill::with('media', 'billable')->get();
        }
        return view('Sameleon.Admin.Payment.__normal_table.index', compact('payments'));
    }
}
