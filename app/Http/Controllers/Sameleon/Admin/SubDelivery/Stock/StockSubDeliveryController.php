<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Stock;

use App\Http\Controllers\Controller;
use App\Repositories\Stock\StockInterface;
use Illuminate\Http\Request;

class StockSubDeliveryController extends Controller
{


    public function index()
    {

        $stocks = app(StockInterface::class)->getStocks();

        return view('Sameleon.Admin.SubDelivery.Stock.index', compact('stocks'));
    }
}
