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
        $deliveries = app(DeliveryInterface::class)->getDeliveries();
        $cities = app(CityInterface::class)->getCities();
        $products = app(ProductInterface::class)->getProducts();

        return view('Sameleon.Admin.Stock.index', compact('deliveries', 'cities', 'products'));
    }

    public function deliveryStock()
    {
        $stocks = app(StockInterface::class)->getStocks();

        return view('Sameleon.Admin.Stock.index', compact('stocks'));
    }

    public function store(StockNewFormRequest $request)
    {

        $product = Product::find($request->product);
        $city = City::find($request->city);
        $delivery = Delivery::find($request->delivery);

        if ($product && $city && $delivery) {

            if ((int) $product->qte_global > (int)$request->qte) {
                $stock = new Stock();
                $stock->product_id = $product->id;
                $stock->product_uuid = $product->uuid;
                $stock->delivery_id = $delivery->id;
                $stock->delivery_uuid = $delivery->uuid;

                $stock->client_id = $product->client->id;
                $stock->client_uuid = $product->client->uuid;

                $stock->city_id = $city->id;
                $stock->city_uuid = $city->uuid;
                $stock->qte_global = (int)$request->qte;
                $stock->qte_rest = (int)$request->qte;
                $stock->sent_at = $request->date('sent_at');
                $stock->notes = $request->notes;
                $stock->save();

                $qteRest = $product->qte_rest -= (int)$request->qte;

                $product->update(['qte_rest' => $qteRest]);

                return redirect()->back()->with('success', "le stock a été créér avec succès");
            } else {
                return redirect()->back()->with('error', "le quantité restant et mois de la quantité includ dans l'ajustement");
            }
        }
        return redirect()->back()->with('error', "Error !!!");
    }

    public function update(StockFormRequest $request, Product $stock)
    {

        if ($request->filled('qte_global')) {

            $stock->clearStock();

            $stock->qte_global =  (int)$request->qte_global;

            $stock->qte_rest =  (int)$request->qte_global;

            $stock->qte_livre =  0;

            $stock->is_out = false;

            $stock->can_ramassage = false;

            $stock->increaseStock((int)$request->qte_global);
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

            $stock->delete();

            return redirect()->back()->with('success', 'le stock a été supprimé avec success');
        }
        return redirect()->back()->with('error', 'error !! ');
    }
}
