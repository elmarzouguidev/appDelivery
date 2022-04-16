<?php

namespace App\Http\Controllers\Sameleon\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Client')) {
            $stocks = Stock::whereUserId(auth()->id())
                ->whereUserUuid(auth()->user()->uuid)
                ->with('product')
                ->get();
        } else {
            $stocks = Stock::with('product')->get();
        }
        return view('Sameleon.Admin.Stock.index', compact('stocks'));
    }
}
