<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Stock\StockInterface;
use Illuminate\Http\Request;

class ProductSubDeliveryController extends Controller
{
    

    public function index()
    {

        $products = app(StockInterface::class)->getStocks();

        return view('Sameleon.Admin.SubDelivery.Product.__normal_table.index', compact('products'));
    }
}
