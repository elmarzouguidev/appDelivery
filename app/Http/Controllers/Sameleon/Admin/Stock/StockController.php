<?php

namespace App\Http\Controllers\Sameleon\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Stock\StockFormRequest;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        /*if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin')) {

            $stocks = Product::with('client')->get();

        } else {

            $stocks = auth()->user()->products()->with('media')->get();

        }*/

        return view('Sameleon.Admin.Stock.index');
    }

    public function update(StockFormRequest $request, Product $stock)
    {
    
        if ($request->filled('qte_global')) {

            $stock->clearStock();

            $stock->qte_global =  (int)$request->qte_global;

            $stock->qte_rest =  (int)$request->qte_global;

            $stock->qte_livre =  0;
            
            $stock->is_out = false;

            $stock->increaseStock((int)$request->qte_global);
        }

        if ($request->filled('qte_endomage') && $request->qte_endomage > 0) {

            $stock->qte_endomage = $stock->qte_endomage + (int)$request->qte_endomage;

        }

        $stock->notes = $request->notes;

        $stock->save();

        return redirect()->back()->with('success', "le stock a été modifier avec succès");
    }
}
