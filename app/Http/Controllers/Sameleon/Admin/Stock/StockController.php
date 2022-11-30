<?php

namespace App\Http\Controllers\Sameleon\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Stock\StockFormRequest;
use App\Http\Requests\Sameleon\Stock\StockNewFormRequest;
use App\Models\Sameleon\City;
use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Stock;
use App\Models\Sameleon\User;
use App\Repositories\City\CityInterface;
use App\Repositories\Delivery\DeliveryInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Stock\StockInterface;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        //$deliveries = app(DeliveryInterface::class)->getDeliveryEntreprise();
        //$cities = app(CityInterface::class)->getCities();
       // $products = app(ProductInterface::class)->getProducts();
        //$stocks = app(StockInterface::class)->getStocks(); // see livewire stock

        //return view('Sameleon.Admin.Stock.index', compact('deliveries', 'cities', 'products'));
        return view('Sameleon.Admin.Stock.index');
    }

    public function deliveryStock()
    {
        $stocks = app(StockInterface::class)->getStocks();

        return view('Sameleon.Admin.Stock.index', compact('stocks'));
    }

    public function store(StockNewFormRequest $request)
    {
        //dd($request->all());

        $product = Product::find($request->product);
        $city = City::find($request->city);
        $delivery = Delivery::find($request->delivery);

        if ($product && $city) {

            $stock = new Stock();
            $stock->product_id = $product->id;
            $stock->product_uuid = $product->uuid;

            $stock->client_id = $product->client->id;
            $stock->client_uuid = $product->client->uuid;

            $stock->city_id = $city->id;
            $stock->city_uuid = $city->uuid;
            $stock->qte_global = (int)$request->qte;
            $stock->qte_rest = (int)$request->qte;
            $stock->sent_at = $request->date('sent_at');
            $stock->notes = $request->notes;

            if ($request->boolean('default_stock') && isAdmin()) {
                $stock->is_default = true;
                $stock->delivery_id = null;
                $stock->delivery_uuid = null;
            } else {
                $stock->is_default = false;
                $stock->delivery_id = $delivery ? $delivery->id : null;
                $stock->delivery_uuid = $delivery ? $delivery->uuid : null;
            }

            $qte = $product->qte_global += (int)$request->qte;

            $product->update(['qte_rest' => $qte, 'qte_global' => $qte]);

            $stock->save();

            return redirect()->back()->with('success', "le stock a été créér avec succès");
        }

        return redirect()->back()->with('error', "Error !!!");
    }

    public function update(StockFormRequest $request, Product $stock)
    {

        if ($request->filled('qte_global')) {

            $stock->qte_global =  (int)$request->qte_global;

            $stock->qte_rest =  (int)$request->qte_global;

            $stock->qte_livre =  0;

            $stock->is_out = false;

            $stock->can_ramassage = false;
        }

        if ($request->filled('qte_endomage') && $request->qte_endomage > 0) {

            $stock->qte_endomage = $stock->qte_endomage + (int)$request->qte_endomage;
        }

        $stock->notes = $request->notes;

        $stock->save();

        if ($stock->ramassage) {

            $stock->ramassage->delete();
        }

        return redirect()->back()->with('success', "le stock a été modifier avec succès");
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
