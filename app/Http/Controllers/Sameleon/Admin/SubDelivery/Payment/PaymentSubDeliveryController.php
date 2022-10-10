<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentSubDeliveryController extends Controller
{
    public function index()
    {
        
        return view('Sameleon.Admin.SubDelivery.Payment.index');
    }
}
