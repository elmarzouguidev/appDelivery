<?php

namespace App\Http\Controllers\Sameleon\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Bill;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole('Client'))
        {
            $payments = Bill::with('media','billable')
            ->where
            ->get();
        }
        else{
            $payments = Bill::with('media','billable')->get();
        }
    
        return view('Sameleon.Admin.Payment.__datatable.index', compact('payments'));
    }
}
