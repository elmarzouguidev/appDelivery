<?php

namespace App\Http\Controllers\Sameleon\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Stock\StockNewDeliveryFormRequest;
use App\Models\Sameleon\City;
use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Stock;
use Illuminate\Http\Request;

class StockDeliveryController extends Controller
{
    public function index()
    {
        return view('Sameleon.Admin.Stock.StockDelivery.index');
    }


    public function delete(Request $request)
    {
        $request->validate(['stockId' => 'required|uuid']);

        $stock = Stock::whereUuid($request->stockId)->firstOrFail();

        if ($stock) {

            $qte = $stock->qte_global -= $stock->qte_global;

            $stock->product->update(['qte_rest' => $qte, 'qte_global' => $qte]);

            $stock->delete();

            return redirect()->back()->with('success', 'le stock a été supprimé avec success');
        }
        return redirect()->back()->with('error', 'error !! ');
    }
}
