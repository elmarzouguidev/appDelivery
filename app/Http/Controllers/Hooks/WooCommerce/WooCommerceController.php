<?php

namespace App\Http\Controllers\Hooks\WooCommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Lead;

class WooCommerceController extends Controller
{

    use DataTrait;

    private $data;


    public function __construct($data)
    {
        $this->data = $data;

        $this->setData();
    }

    public function setData()
    {
        $fields = $this->detachData();

        $validateData = $this->getRequest();

        $validator = Validator::make($fields, $validateData->rules());

        if ($validator->fails()) {

            Log::error($validator->errors());
        }

        $items =  $validator->validated();
        Log::info($items);
        Lead::create([
            'nom' => $items['first_name'],
            'prenom' => $items['last_name'],
            'email' => $items['email'],
            'tele' => $items['phone'],
            'ville' => $items['city'],
            'address' => $items['address_1'],
            'produit' => 'titan'
        ]);
    }
}
