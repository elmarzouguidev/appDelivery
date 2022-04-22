<?php

namespace App\Http\Controllers\Sameleon\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Stock\StockFormRequest;
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

    public function update(StockFormRequest $request, Stock $stock)
    {

        // dd($request->all(), "##", $stock);

        if ($request->filled('qte_global')) {

            $stock->qte_global = $stock->qte_global + (int)$request->qte_global;
        }

        if ($request->filled('qte_endomage') && $request->qte_endomage > 0) {

            $stock->qte_endomage = (int)$request->qte_endomage;
        }

        $stock->notes = $request->notes;

        $stock->save();

        return redirect()->back()->with('success', "le stock a été modifier avec succès");
    }

    public function delete(Request $request)
    {

        $request->validate(['stockId' => 'required|uuid']);

        $stock = Stock::whereUuid($request->stockId)->first();

        if ($stock) {
            
            $stock->delete();

            return redirect()->back()->with('success', "le stock a été supprimer avec succès");
        }

        return redirect()->back()->with('error', "Error");
    }
}
