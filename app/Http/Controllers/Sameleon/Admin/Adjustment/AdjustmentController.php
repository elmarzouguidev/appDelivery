<?php

namespace App\Http\Controllers\Sameleon\Admin\Adjustment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Adjustment\AdjustmentFormRequest;
use App\Repositories\City\CityInterface;
use App\Repositories\Delivery\DeliveryInterface;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;

class AdjustmentController extends Controller
{
    //

    public function create()
    {
        $cities = app(CityInterface::class)->getCities();
        $deliveries = app(DeliveryInterface::class)->getDeliveries();
        $products = app(ProductInterface::class)->getProducts();

        return view('Sameleon.Admin.Adjustment.__create.index', compact('cities', 'deliveries', 'products'));
    }

    public function store(AdjustmentFormRequest $request)
    {

        dd('Yello',$request->all());

    }
}
