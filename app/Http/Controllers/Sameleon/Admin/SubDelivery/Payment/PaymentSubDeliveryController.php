<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Payment;

use App\Http\Controllers\Controller;
use App\Repositories\Bill\BillInterface;
use Illuminate\Http\Request;

class PaymentSubDeliveryController extends Controller
{
    public function index()
    {
        
        $payments = app(BillInterface::class)->getBills();

        return view('Sameleon.Admin.SubDelivery.Payment.index',compact('payments'));
    }
}
