<?php

namespace App\Http\Controllers\Sameleon\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Repositories\Bill\BillInterface;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = app(BillInterface::class)->getBills();

        return view('Sameleon.Admin.Payment.__normal_table.index', compact('payments'));
    }
}
